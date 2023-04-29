<?php

namespace App\Http\Controllers\Guest;

use App\Models\Order;
use App\Models\Advert;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;
use App\Models\Shipment;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    use GeoLocationTrait;
    
    public function index(){
        $categories = Category::orderBy('name','ASC')->take(8)->get();
        $state_id = session('locale')['state_id'];
        $advert_A = Advert::withinState($state_id)->running()->certifiedShop()->where('position',"A")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_B = Advert::withinState($state_id)->running()->certifiedShop()->where('position',"B")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_Z = Advert::with('product')->within($state_id)->running()->certifiedProduct()->where('position',"Z")->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        return view('frontend.index',compact('categories','advert_A','advert_B','advert_Z'));
    }
    
    public function redirect(Advert $advert){
        $advert->clicks =+ 1;
        $advert->save();
        if($advert->advertable_type == 'App\Models\Product'){
            return redirect()->route('product.show',$advert->advertable);
        }else{
            return redirect()->route('vendor.show',$advert->advertable);
        } 
    }

    public function shipment(Order $order=null){
        if(!$order){
            return view('frontend.logistics.search');
        }elseif($order->shipments->isEmpty() || $order->shipments->where('delivered_at',null)->isEmpty()){
            return redirect()->back()->with(['result'=> 0,'message'=> 'Shipment not found']);
        }
        else return view('frontend.logistics.search',compact('order'));
    }

    public function shipment_search(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'order_number' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $order = Order::where('slug',$request->order_number)->first();
        if(!$order || $order->shipments->isEmpty()){
            return redirect()->back()->with(['result'=> 0,'message'=> 'Shipment not found']);
        }
        $shipment = $order->shipments->firstWhere('delivered_at','!=',null);
        if(!$shipment || $shipment->created_at->format('ymdhi') != strrev($request->password)){
           return redirect()->back()->with(['result'=> 0,'message'=> 'Incorrect credentials supplied']);
        }
        return redirect()->route('shipment',$order);

    }

    public function shipment_update(Request $request){
        $shipment = Shipment::find($request->shipment_id);
        if($request->action == 'shipped') $shipment->shipped_at = now();
        if($request->action == 'delivered') $shipment->delivered_at = now();
        $shipment->save();
        return redirect()->back()->with(['result'=> 1,'message'=> 'Shipment Status Updated']);
    }

}
