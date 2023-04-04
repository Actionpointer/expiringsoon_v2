<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rate;
use App\Models\State;
use App\Models\Country;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShipmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rates(){
        $countries = Country::all();
        $states = State::within()->get();
        $rates = Rate::within()->whereNull('shop_id')->paginate(10);
        return view('admin.shipments.rates',compact('rates','countries','states'));
    }

    public function store(Request $request){
        $rate = new Rate;
        $rate->country_id = $request->country_id;
        $rate->origin_id = $request->origin_id;
        $rate->destination_id = $request->destination_id;
        $rate->hours = $request->hours;
        $rate->amount = $request->amount;
        $rate->save();
        return redirect()->back()->with(['result'=>1,'message'=> 'Shipping Rate Saved']);
    }

    public function update(Request $request){
        // dd($request->all());
        $rate = Rate::find($request->rate_id);
        $rate->country_id = $request->country_id;
        $rate->origin_id = $request->origin_id;
        $rate->destination_id = $request->destination_id;
        $rate->hours = $request->hours;
        $rate->amount = $request->amount;
        $rate->save();
        return redirect()->back()->with(['result'=>1,'message'=> 'Shipping Rate Updated']);
    }
    
    public function destroy(Request $request){
        $rate = Rate::where('id',$request->rate_id)->delete();
        return redirect()->back()->with(['result'=>1,'message'=> 'Shipping Rate Deleted']);
    }

    /*deliveries */
    public function index(){
        $shippings = Shipping::within()->paginate(10);
        return view('admin.shipments.index',compact('shippings'));
    }

    public function process(Request $request){
        //
    }
    
}

