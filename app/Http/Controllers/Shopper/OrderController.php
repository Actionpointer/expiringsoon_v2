<?php

namespace App\Http\Controllers\Shopper;


use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\OrderMessage;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Traits\WishlistTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Events\BroadcastOrderMessage;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderDetailsResource;
use App\Http\Resources\OrderMessageResource;
use App\Notifications\OrderMessageNotification;

class OrderController extends Controller
{
    use CartTrait,WishlistTrait,PaymentTrait;

    public function __construct(){
        $this->middleware('auth:sanctum');
    }
    
    public function index($status = null){
        $user = auth()->user();
        
        $orders = Order::where('user_id',$user->id);
        if(!$status){
            $orders = $orders->whereHas('statuses');
        }
        if($status == 'opened'){
            $orders = $orders->whereHas('statuses',function($query){$query->whereNotIn('name',['cancelled','completed','closed','refunded']);});
        }
        if($status == 'closed'){
            $orders = $orders->whereHas('statuses',function($query){$query->whereIn('name',['cancelled','completed','closed','refunded']);});
        }
        $orders = $orders->orderBy('created_at','desc')->paginate(16);
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => $orders->count() ? 'Orders retrieved Successfully':'No Order',
                'data' => OrderResource::collection($orders),
                'count' => $orders->count()
            ], 200) :
            view('customer.orders.list',compact('user','orders')); 
    }
    
    public function show(Order $order){
        DB::table('notifications')->whereNull('read_at')->where('notifiable_id',auth()->id())->where('notifiable_type','App\Models\User')->whereJsonContains('data->related_to','order')->whereJsonContains('data->id',$order->id)->update(['read_at'=> now()]);
        OrderMessage::where(function($query) use($order){
            return $query->where('order_id',$order->id)->where('receiver_id',auth()->id())->where('receiver_type','App\Models\User')->whereNull('read_at');
        })->update(['read_at'=> now()]);
        $messages = OrderMessage::where(function($query) use($order){
            return $query->where('order_id',$order->id)->where('receiver_id',$order->user_id)->where('receiver_type','App\Models\User');
        })->orWhere(function($qeury) use($order){
            return $qeury->where('order_id',$order->id)->where('sender_id',$order->user_id)->where('sender_type','App\Models\User');
        })->orderBy('created_at','desc')->get();

        $statuses = $this->getCustomerOrderStatuses($order);
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => $order->items->count() ? 'Order Details retrieved Successfully' :'No details retrieved',
                'data' => new OrderDetailsResource($order),
            ], 200):
            view('customer.orders.view',compact('order','messages','statuses'));
    }

    public function update(Request $request){
        // dd($request->all());
        switch(strtolower($request->status)){
            
            case 'cancelled':
                    $message = 'User Cancelled Order';
                break;
            case 'completed': 
                    $message = 'Order has been completed';
                break;
            case 'rejected':
                $items = OrderItem::where('order_id',$request->order_id)->whereHas('product',function($query){
                    $query->isValid();
                })->get();

                if($items->isEmpty()){
                    return request()->expectsJson() ? 
                        response()->json([
                            'status' => false,
                            'message' => 'No item in the order is valid for return',
                        ], 401) :
                        redirect()->back()->with(['result'=> 0,'message'=> 'No item in the order is valid for return']);
                }
                $message = $request->description;
                break;
            case 'returned':
                    $message = 'Order has been returned';
                break;
        }
        OrderStatus::create(['order_id'=> $request->order_id,'user_id'=> auth()->id(),'name'=> strtolower($request->status),'description'=> $message]);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Order Updated Successfully',
        ], 200) :
         redirect()->back()->with(['result'=> 1,'message'=> 'Order Updated Successfully']);
    }
    
    public function messages(Order $order){
        $user = auth()->user();
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Order Messages',
            'data' => OrderMessageResource::collection($order->messages),
        ], 200):
        view('customer.orders.messages',compact('order'));
    }
    
    public function message(Request $request){
        $order = Order::find($request->order_id);
        $message = OrderMessage::create(['order_id'=> $order->id,'sender_id'=> $request->sender_id,'sender_type'=>'App\Models\User','receiver_id'=> $request->receiver_id ,'receiver_type'=> $request->receiver_type, 'body'=> $request->body]);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Message Sent Successfully',
        ], 200) :
         redirect()->back()->with(['result'=> 1,'message'=> 'Message sent']);
    }

    
}
