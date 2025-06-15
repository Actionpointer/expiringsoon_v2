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
        return view('frontend.index',compact('categories'));
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
