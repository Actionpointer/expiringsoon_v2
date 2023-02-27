<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Review;
use App\Models\OrderStatus;
use App\Models\OrderMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderDetailsResource;
use App\Http\Resources\OrderMessageResource;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //vendors
    public function index(Shop $shop,$status = null){
        if($status == 'opened'){
            $orders = Order::where('shop_id',$shop->id)->whereHas('statuses',function($query){$query->whereIn('name',['processing','shipped','delivered']);})->get();
        }
        if($status == 'closed'){
            $orders = Order::where('shop_id',$shop->id)->whereHas('statuses',function($query){$query->whereIn('name',['cancelled','completed','closed']);})->get();
        }
        if(!$status){
            $orders = Order::where('shop_id',$shop->id)->get();
        }
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => $orders->count() ? 'Shop Orders retrieved Successfully':'No Order retrieved',
            'data' => OrderResource::collection($orders),
            'count' => $orders->count()
        ], 200) :
        view('vendor.shop.orders.list',compact('shop'));

    }
    

    public function show(Shop $shop,Order $order){
        if(!request()->expectsJson()){
            OrderMessage::where('order_id',$order->id)->where('receiver_id',$shop->id)->where('receiver_type','App\Models\Shop')->whereNull('read_at')->update(['read_at'=>now()]);
        }
        $allow_update = false;
        if($order->status == 'processing')
        $allow_update = true;
        if($order->status == 'ready' && $order->deliverer == "vendor")
        $allow_update = true;
        if($order->status == 'shipped' && $order->deliverer == "vendor")
        $allow_update = true;
        if($order->status == 'returned' && $order->statuses->firstWhere('name','returned')->created_at->addHours(cache('settings')['order_rejected_to_acceptance_period']) > now())
        $allow_update = true;

        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => $order->items->count() ? 'Order Details retrieved Successfully' :'No details retrieved',
                'data' => OrderDetailsResource::collection($order->items),
                'count' => $order->items->count()
            ], 200):
            view('vendor.shop.orders.view',compact('shop','order','allow_update'));
    }


    public function update(Request $request){
        OrderStatus::create(['order_id'=> $request->order_id,'user_id'=> auth()->id(),'name'=> $request->status]);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Order Updated Successfully',
        ], 200) :
         redirect()->back()->with(['result'=> 1,'message'=> 'Order Updated Successfully']);
    }

    public function messages(Shop $shop,Order $order){
        OrderMessage::where('order_id',$order->id)->where('receiver_id',$shop->id)->where('receiver_type','App\Models\Shop')->whereNull('read_at')->update(['read_at'=>now()]);
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
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Message Sent Successfully',
        ], 200) :
         redirect()->back();
    }
}
