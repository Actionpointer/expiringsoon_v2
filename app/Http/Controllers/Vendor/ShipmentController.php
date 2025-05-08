<?php

namespace App\Http\Controllers\Vendor;

use App\Models\City;
use App\Models\Rate;
use App\Models\Store;
use App\Models\Package;
use App\Models\PackageRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PackageRateResource;
use App\Http\Resources\ShipmentRateResource;

class ShipmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Shop $shop){
        try {
            $rates = Rate::where('shop_id',$shop->id)->get();
            if(request()->expectsJson()){
                return response()->json([
                    'status' => true,
                    'message' => $rates->count() ? 'Shipping rates fetched Successfully' : 'No shipping rates found',
                    'data'=> ShipmentRateResource::collection($rates),
                    'count' => $rates->count()
                ], 200);
            }else{
                $states = $shop->country->states;
                $cities = City::where('state_id',$shop->state_id)->get();
                return view('vendor.shop.shipment',compact('rates','states','cities','shop'));
            }
            
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
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
                    'message'=> $validator->errors()->first()
                ], 401);
            }
            $shop = Shop::find($request->shop_id);
            $rate = Rate::updateOrCreate(['shop_id'=> $shop->id ,'country_id'=> $shop->country_id,'destination_id'=> $request->destination_id,'origin_id'=> $shop->state_id],['hours'=> $request->hours,'amount'=> $request->amount]);
           
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
                    'message'=> $validator->errors()->first()
                ], 401);
            }
            $rate = Rate::where('id',$request->rate_id)->where('shop_id',$request->shop_id)->first();
            if(!$rate){
                return response()->json([
                    'status' => false,
                    'message' => 'Shipping Rate Not found',

                ], 401);
            }
            $rate = Rate::where('id',$request->rate_id)->where('shop_id',$request->shop_id)->update(['destination_id'=> $request->destination_id,'hours'=> $request->hours,'amount'=> $request->amount]);
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
                        'message'=> $validator->errors()->first()
                    ], 401);
                }
                $rate = Rate::where('id',$request->rate_id)->where('shop_id',$request->shop_id)->delete();
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

    public function package_rate(Request $request){
        $shop = Shop::where('id',$request->shop_id)->update(['dimension_rate'=> $request->dimension_rate,'weight_rate'=> $request->weight_rate]);
        return request()->expectsJson() ?
        response()->json([
            'status' => true,
            'message' => 'Package rates updated Successfully',
        ], 200) :
        redirect()->back()->with(['result'=> 1,'message'=> 'Package Rate Updated']);
    }

    
    
}
