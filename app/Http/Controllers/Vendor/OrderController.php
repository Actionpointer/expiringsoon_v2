<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Review;
use App\Models\OrderMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //vendors
    public function index(Shop $shop){
        return view('shop.orders.list',compact('shop'));
    }

    public function show(Shop $shop,Order $order){
        OrderMessage::where('order_id',$order->id)->where('shop_id',$shop->id)->where('receiver','vendor')->whereNull('read_at')->update(['read_at'=>now()]);
        return view('order',compact('shop','order'));
    }

    public function manage(Shop $shop,Request $request){
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();
        return redirect()->back();
    }
    
}
