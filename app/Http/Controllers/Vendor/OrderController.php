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
    public function index(Shop $shop,$status = null){
        if($status == 'opened'){
            $orders = Order::where('shop_id',$shop->id)->whereIn('status',['new','processing','shipped','delivered'])->get();
        }
        if($status == 'closed'){
            $orders = Order::where('shop_id',$shop->id)->whereIn('status',['cancelled','completed'])->get();
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
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => $order->items->count() ? 'Order Details retrieved Successfully' :'No details retrieved',
                'data' => OrderDetailsResource::collection($order->items),
                'count' => $order->items->count()
            ], 200):
            view('order.view',compact('shop','order'));
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
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Order Message',
            'data' => OrderMessageResource::collection($order->messages),
        ], 200):
         view('order.messages',compact('shop','order'));
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
