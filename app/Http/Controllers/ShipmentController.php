<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\State;
use App\Models\ShippingRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // return 'ok';
       \App\Jobs\SubscriptionRenewalJob::dispatch();
       return 'ok';
    }

    public function vendor_shipping_rates(Shop $shop,Request $request){
        if($request->rate_id){
            if($request->delete){
                $user = ShippingRate::destroy($request->rate_id);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Deleted Shipping Rate']);
            }else{
                //update
                $validator = Validator::make($request->all(), [
                    'destination_id' => 'required|numeric',
                    'hours' => 'required|numeric',
                    'amount' => 'required|numeric',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> 'Could not update shipping rate']);
                }
                $rate = ShippingRate::where('id',$request->rate_id)->update(['destination_id'=> $request->destination_id,'hours'=> $request->hours,'amount'=> $request->amount]);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Updated Shipping Rate']);
            }
        }else{
            //create
            $validator = Validator::make($request->all(), [
                'destination_id' => 'required|numeric',
                'hours' => 'required|numeric',
                'amount' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> 'Could not create shipping rate']);
            }
            $rate = ShippingRate::create(['shop_id'=> $shop->id ,'origin_id'=> $shop->state_id,'destination_id'=> $request->destination_id,'hours'=> $request->hours,'amount'=> $request->amount]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'Shipping Rate created successfully']);
        } 
    }

    public function admin_shipping_rates(Request $request){
        if($request->rate_id){
            if($request->delete){
                $rate = ShippingRate::where('id',$request->rate_id)->delete();
            }else{
                $rate = ShippingRate::find($request->rate_id);
                $rate->origin_id = $request->origin_id;
                $rate->destination_id = $request->destination_id;
                $rate->hours = $request->hours;
                $rate->amount = $request->amount;
                $rate->save();
            }  
        }else{
            $rate = new ShippingRate;
            $rate->origin_id = $request->origin_id;
            $rate->destination_id = $request->destination_id;
            $rate->hours = $request->hours;
            $rate->amount = $request->amount;
            $rate->save();
        }
        return redirect()->back()->with(['result'=>1,'message'=> 'Shipping Settings Saved']);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    
    
}
