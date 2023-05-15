<?php

namespace App\Http\Controllers\Guest;

use App\Models\Order;
use App\Models\Advert;
use App\Models\Category;
use App\Models\Shipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    use GeoLocationTrait;
    
    public function index(){
        $categories = Category::orderBy('name','ASC')->take(8)->get();
        $state_id = session('locale')['state_id'];
        // $advert_A = Advert::withinState($state_id)->running()->certifiedShop()->where('position',"A")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        // $advert_B = Advert::withinState($state_id)->running()->certifiedShop()->where('position',"B")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_Z = Advert::with('product')->within($state_id)->running()->certifiedProduct()->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_A = null;
        $advert_B = null;
        $advert_C = null;
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

    public function shipment(){
        if(!request()->input('order') || !request()->input('password')){
            return view('frontend.logistics.search');
        }
        if(request()->input('order') && request()->input('password')){
            $order = Order::where('slug',request()->input('order'))->first();
            if(!$order || $order->shipments->isEmpty()){
                return redirect()->route('shipment')->with(['result'=> 0,'message'=> 'Shipment not found']);
            }
            if($order->shipments->where('delivered_at',null)->isEmpty()){
                return redirect()->route('shipment')->with(['result'=> 1,'message'=> 'Shipment already completed']);
            }
            $shipment = $order->shipments->firstWhere('delivered_at',null);
            if(!$shipment || $shipment->created_at->format('ymdhi') != strrev(request()->input('password'))){
                return redirect()->route('shipment')->with(['result'=> 0,'message'=> 'Incorrect credentials supplied']);
            }
            return view('frontend.logistics.search',compact('order'));
        }
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
        return redirect()->route('shipment',['order'=> $request->order_number,'password'=>$request->password]);

    }

    public function shipment_update(Request $request){
        $shipment = Shipment::find($request->shipment_id);
        if($request->action == 'shipped') $shipment->shipped_at = now();
        if($request->action == 'delivered') $shipment->delivered_at = now();
        $shipment->save();
        return redirect()->route('shipment')->with(['result'=> 1,'message'=> 'Shipment Status Updated']);
    }

}
