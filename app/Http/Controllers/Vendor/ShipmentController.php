<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Shop;
use App\Models\State;
use App\Models\ShippingRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ShipmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), 
            [
                'shop_id' => 'required|numeric',
                'destination_id' => 'required|numeric',
                'hours' => 'required|string',
                'amount' => 'required|string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validator->errors()->first()
                ], 401);
            }
            $shop = Shop::find($request->shop_id);
            $rate = new ShippingRate;
            $rate->origin_id = $shop->state_id;
            $rate->destination_id = $request->destination_id;
            $rate->hours = $request->hours;
            $rate->amount = $request->amount;
            $rate->save();
            return request()->expectsJson() ?
             response()->json([
                'status' => true,
                'message' => 'Successfully Created Shipping Rate',
            ], 200) :
            redirect()->back()->with(['result'=> 1,'message'=> 'Shipping Rate created successfully']);
            
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        
    }


    public function index($shop_id){
        try {
        $shop = Shop::find($shop_id);
        $rates = ShippingRate::where('shop_id',$shop->id)->get();
        return response()->json([
            'status' => true,
            'message' => 'Shipping rates fetched Successfully',
            'data'=> $rates
        ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    
    public function update(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'shop_id' => 'required|numeric',
                'rate_id' => 'required|numeric',
                'destination_id' => 'required|numeric',
                'hours' => 'required|string',
                'amount' => 'required|string',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validator->errors()->first()
                ], 401);
            }
            $rate = ShippingRate::where('id',$request->rate_id)->where('shop_id',$request->shop_id)->first();
            if(!$rate){
                return response()->json([
                    'status' => false,
                    'message' => 'Shipping Rate Not found',

                ], 401);
            }
            $rate = ShippingRate::where('id',$request->rate_id)->where('shop_id',$request->shop_id)->update(['destination_id'=> $request->destination_id,'hours'=> $request->hours,'amount'=> $request->amount]);
            return request()->expectsJson() ?
             response()->json([
                'status' => true,
                'message' => 'Successfully Updated Shipping Rate',
            ], 200) :
            redirect()->back()->with(['result'=> 1,'message'=> 'Shipping Rate updated successfully']);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request){
        try {
                $validator = Validator::make($request->all(), 
                [
                    'shop_id' => 'required|numeric',
                    'rate_id' => 'required|numeric',
                ]);

                if($validator->fails()){
                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'error' => $validator->errors()->first()
                    ], 401);
                }
                $rate = ShippingRate::where('id',$request->rate_id)->where('shop_id',$request->shop_id)->delete();
                return request()->expectsJson() ?
                response()->json([
                    'status' => true,
                    'message' => 'Successfully Deleted Shipping Rate',
                ], 200) :
                redirect()->back()->with(['result'=> 1,'message'=> 'Shipping Rate deleted successfully']);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
    }
    
    
}
