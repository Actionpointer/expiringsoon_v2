<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\OrderStatus;
use App\Models\OrderMessage;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderDetailsResource;
use App\Http\Resources\OrderMessageResource;
use App\Notifications\OrderMessageNotification;

class OrderController extends Controller
{
    use OrderTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Shop $shop,$status = null){
        
        $orders = Order::where('shop_id',$shop->id);
        if($status == 'opened'){
            $orders = $orders->whereHas('statuses',function($query){$query->whereIn('name',['processing','shipped','delivered']);});
        }
        if($status == 'closed'){
            $orders = $orders->whereHas('statuses',function($query){$query->whereIn('name',['cancelled','completed','closed']);});
        }
        if(!$status){
            $orders = $orders->whereHas('statuses');
        }
        $orders = $orders->orderBy('created_at','desc')->paginate(16);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => $orders->count() ? 'Shop Orders retrieved Successfully':'No Order retrieved',
            'data' => OrderResource::collection($orders),
            'meta'=> [
                "total"=> $orders->total(),
                "per_page"=> $orders->perPage(),
                "current_page"=> $orders->currentPage(),
                "last_page"=> $orders->lastPage(),
                "first_page_url"=> $orders->url(1),
                "last_page_url"=> $orders->url($orders->lastPage()),
                "next_page_url"=> $orders->nextPageUrl(),
                "prev_page_url"=> $orders->previousPageUrl(),
            ]
        ], 200) :
        view('vendor.shop.orders.list',compact('shop','orders'));

    }
    

    public function show(Shop $shop,Order $order){
        $notifications = DB::table('notifications')->whereNull('read_at')->where('notifiable_id',$shop->id)->where('notifiable_type','App\Models\Shop')->whereJsonContains('data->related_to','order')->whereJsonContains('data->id',$order->id)->update(['read_at'=> now()]);
        $messages = OrderMessage::where(function($query) use($order){
            return $query->where('order_id',$order->id)->where('receiver_id',$order->shop_id)->where('receiver_type','App\Models\Shop');
        })->orWhere(function($qeury) use($order){
            return $qeury->where('order_id',$order->id)->where('sender_id',$order->shop_id)->where('sender_type','App\Models\Shop');
        })->orderBy('created_at','desc')->get();
        $statuses = $this->getVendorOrderStatuses($order);
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => $order->items->count() ? 'Order Details retrieved Successfully' :'No details retrieved',
                'data' => new OrderDetailsResource($order)
            ], 200):
            view('vendor.shop.orders.view',compact('shop','order','statuses','messages'));
    }


    public function update(Request $request){
        $order = Order::find($request->order_id);
        OrderStatus::create(['order_id'=> $request->order_id,'user_id'=> $order->user_id,'name'=> strtolower($request->status)]);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Order Updated Successfully',
        ], 200) :
         redirect()->back()->with(['result'=> 1,'message'=> 'Order Updated Successfully']);
    }

    public function messages(Shop $shop,Order $order){
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Order Messages',
            'data' => OrderMessageResource::collection($order->messages),
        ], 200):
         view('vendor.shop.orders.messages',compact('shop','order'));
    }


    public function message(Shop $shop,Request $request){
        $order = Order::find($request->order_id);
        $message = OrderMessage::create(['order_id'=> $request->order_id,'sender_id'=> $request->sender_id,'sender_type'=> 'App\Models\Shop','receiver_id'=> $request->receiver_id ,'receiver_type'=> $request->receiver_type,'body'=> $request->body]);
        if($message->receiver_type == 'App\Models\User'){
            $receiver = User::find($message->receiver_id);
        }else{
            $receiver = Shop::find($message->receiver_id);
        }
        $receiver->notify(new OrderMessageNotification($message));
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Message Sent Successfully',
        ], 200) :
         redirect()->back();
    }
}
