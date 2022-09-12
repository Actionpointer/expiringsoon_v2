<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\State;
use App\Models\ShippingRate;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        //
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
    public function admin_rates(Request $request){
        if($request->rate_id){
            if($request->option){
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
        return redirect()->back();
    }
    
}
