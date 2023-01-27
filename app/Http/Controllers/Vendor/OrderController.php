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
        OrderMessage::where('order_id',$order->id)->where('shop_id',$shop->id)->where('receiver','vendor')->whereNull('read_at')->update(['read_at'=>now()]);
        return view('order',compact('shop','order'));
    }

    public function api_show($order_id){
        $order = Order::find($order_id);
        return response()->json([
            'status' => true,
            'message' => 'Order Details retrieved Successfully',
            'data' => new OrderDetailsResource($order),
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
    
}
