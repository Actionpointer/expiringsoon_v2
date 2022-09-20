<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Order;
use App\Models\OrderMessage;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user = auth()->user();
        return view('customer.orders.list',compact('user'));
    }
    public function show(Order $order){
        $user = auth()->user();
        OrderMessage::where('order_id',$order->id)->where('user_id',$user->id)->where('receiver',$user->role)->whereNull('read_at')->update(['read_at'=>now()]);
        return view('order',compact('order'));
    }

    public function message(Request $request){
        $order = Order::find($request->order_id);
        $message = OrderMessage::create(['user_id'=> $order->user_id,'order_id'=> $order->id,'shop_id'=> $order->shop_id,'body'=> $request->body,'sender'=> $request->sender,'receiver' => $request->receiver]);
        return redirect()->back();
    }

    //vendors
    public function shop_orders(Shop $shop){
        return view('shop.orders.list',compact('shop'));
    }

    public function shop_order_view(Shop $shop,Order $order){
        OrderMessage::where('order_id',$order->id)->where('shop_id',$shop->id)->where('receiver','vendor')->whereNull('read_at')->update(['read_at'=>now()]);
        return view('order',compact('shop','order'));
    }

    public function manage(Shop $shop,Request $request){
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();
        return redirect()->back();
    }

    //admin order

    public function admin_index()
    {
        $orders = Order::orderBy('created_at','desc')->get();
        return view('admin.orders',compact('orders'));
    }

    // public function admin_shipping()
    // {
    //     $shippings = Shipping::all();
    //     return view('admin.shipping',compact('shippings'));
    // }

    
}
