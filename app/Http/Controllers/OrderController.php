<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //users
        $user = auth()->user();
        return view('customer.orders',compact('user'));
    }
    public function show(Order $order)
    {
        //
    }

    //vendors
    public function sales(Shop $shop)
    {
        return view('shop.sales',compact('shop'));
    }
    public function view(Shop $shop,Order $order){

    }

    public function process(Request $request)
    {
        //
    }

    //admin order
    

    public function adminIndex()
    {
        $orders = Order::orderBy('created_at','desc')->get();
        return view('admin.orders',compact('orders'));
    }

    public function adminShipping()
    {
        $shippings = Shipping::all();
        return view('admin.shipping',compact('shippings'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
