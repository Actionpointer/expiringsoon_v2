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

    public function shipping_index($shop_id){
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

    public function shipping_store(Request $request){
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
            return response()->json([
                'status' => true,
                'message' => 'Successfully Created Shipping Rate',
            ], 200);
            
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        
    }

    public function shipping_update(Request $request){
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
            
            return response()->json([
                'status' => true,
                'message' => 'Successfully Updated Shipping Rate',
            ], 200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function shipping_delete(Request $request){
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
                return response()->json([
                    'status' => true,
                    'message' => 'Successfully Deleted Shipping Rate',
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
    }
    
    
}
