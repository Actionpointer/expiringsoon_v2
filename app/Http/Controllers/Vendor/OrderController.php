<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Review;
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
    public function index(Shop $shop){
        return view('vendor.shop.orders.list',compact('shop'));
    }
    
    public function api_index($shop_id,$status = null){
        if($status == 'opened'){
            $orders = Order::where('shop_id',$shop_id)->whereIn('status',['new','processing','shipped','delivered'])->get();
        }
        if($status == 'closed'){
            $orders = Order::where('shop_id',$shop_id)->whereIn('status',['cancelled','completed'])->get();
        }
        if(!$status){
            $orders = Order::where('shop_id',$shop_id)->get();
        }
        return response()->json([
            'status' => true,
            'message' => $orders->count() ? 'Shop Orders retrieved Successfully':'No Order retrieved',
            'data' => OrderResource::collection($orders),
            'count' => $orders->count()
        ], 200);
    }

    public function show(Shop $shop,Order $order){
        
        // OrderMessage::where('order_id',$order->id)->where('shop_id',$shop->id)->where('receiver','vendor')->whereNull('read_at')->update(['read_at'=>now()]);
        return view('order.view',compact('shop','order'));
    }

    public function api_show($order_id){
        $order = Order::find($order_id);
        return response()->json([
            'status' => true,
            'message' => 'Order Details retrieved Successfully',
            'data' => OrderDetailsResource::collection($order->items),
        ], 200);
    }

    public function update(Request $request){
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Order Updated Successfully',
        ], 200) :
         redirect()->back();
    }

    public function messages(Shop $shop,Order $order){
        OrderMessage::where('order_id',$order->id)->where('sender_id',$shop->id)->where('sender_type','App\Models\Shop')->whereNull('read_at')->update(['read_at'=>now()]);
        return view('order.messages',compact('shop','order'));
    }

    public function api_messages($shop_id,$order_id){
        $order = Order::where('id',$order_id)->where('shop_id',$shop_id)->first();
        return response()->json([
            'status' => true,
            'message' => 'Order Message',
            'data' => OrderMessageResource::collection($order->messages),
        ], 200);
    }

    public function message(Shop $shop,Request $request){
        $order = Order::find($request->order_id);
        $message = OrderMessage::create(['order_id'=> $request->order_id,'sender_id'=> $request->sender_id,'sender_type'=> 'App\Models\Shop','body'=> $request->body]);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Message Sent Successfully',
        ], 200) :
         redirect()->back();
    }
}
