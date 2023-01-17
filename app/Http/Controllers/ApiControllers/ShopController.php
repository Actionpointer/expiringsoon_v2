<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Shop;
use App\Events\DeleteShop;
use App\Models\ShippingRate;
use Illuminate\Http\Request;
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    use SecurityTrait;

    public function index(){
        $user = auth()->user();
        $shops = $user->shops;
        if($shops->count()){
            return response()->json([
                'status' => true,
                'message' => 'Shops retrieved Successfully',
                'data' => $shops,
                'count' => $shops->count()
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'No Shops retrieved',
                'data' => null,
                'count' => 0
            ], 200);
        }   
    }

    public function show($shop_id){
        $shop = Shop::find($shop_id);
        if($shop && $shop->user_id == auth()->id()){
            return response()->json([
                'status' => true,
                'message' => 'Shop retrieved Successfully',
                'data' => ['shop_id'=> $shop->id,'name'=> $shop->name,'wallet_balance'=> 0,'owner'=> auth()->user()->name,'products'=> $shop->products->count()]
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Shop does not exist',
                'data' => null,
                'count' => 0
            ], 200);
        }
    }

    public function import(Request $request){
        $user = auth()->user();
        try {
            //Validated
            $validator = Validator::make($request->all(), 
            [
                'name' => 'required|max:255',
                'address' => 'required|string',
                'state_id' => 'required|numeric',
                'city_id' => 'required|numeric',
                'email' => 'required|string|unique:users',
                'photo' => ['required','string','url','not-regex:(.svg|.gif)']
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validator->errors()->first()
                ], 401);
            }
            $size = getimagesize($request->photo);
            $extension = image_type_to_extension($size[2]);
            $banner = 'public/uploads/'.time().'.'.$extension;
            $contents = file_get_contents($request->photo);
            Storage::put($banner, $contents);
            $shop = Shop::create(['name'=> $request->name,'user_id'=> $user->id ,'email'=>$request->email,'phone_prefix'=> cache('settings')['dialing_code'],'phone'=>$request->phone,'banner'=>$banner,
            'address'=> $request->address,'state_id'=> $request->state_id,'city_id'=> $request->city_id,'published'=> 1]);
            
            return response()->json([
                'status' => true,
                'message' => 'Shop Created Successfully',
                'data' => ['shop_id'=> $shop->id,'name'=> $shop->id,'wallet_balance'=> 0,'owner'=> auth()->user(),'products'=> $shop->products->count() ,'create_shops_remaining'=> $shop->user->allowedShops()]
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        $user = auth()->user();
        try {
            //Validated
            $validator = Validator::make($request->all(), 
            [
                'name' => 'required|max:255',
                'address' => 'required|string',
                'state_id' => 'required|numeric',
                'city_id' => 'required|numeric',
                'email' => 'required|string|unique:users',
                'phone' => 'required|string|unique:users',
                'photo' => 'required|max:1024|image',
                'published' => 'required|numeric',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validator->errors()->first()
                ], 401);
            }

            if($request->hasFile('photo')){
                $banner = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->storeAs('public/',$banner);
            }
            $shop = Shop::create(['name'=> $request->name,'user_id'=> $user->id ,'email'=>$request->email,'phone_prefix'=> cache('settings')['dialing_code'],'phone'=>$request->phone,'banner'=>$banner,
            'address'=> $request->address,'state_id'=> $request->state_id,'city_id'=> $request->city_id,'published'=> $request->published]);
            
            return response()->json([
                'status' => true,
                'message' => 'Shop Created Successfully',
                'data' => ['shop_id'=> $shop->id,'name'=> $shop->id,'wallet_balance'=> 0,'products'=> $shop->products->count() ,'create_shops_remaining'=> $shop->user->allowedShops()]
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request){
        $user = auth()->user();
        try {
                $validator = Validator::make($request->all(), 
                [
                    'shop_id' => 'required|numeric',
                    'pin' => 'required|numeric',
                    'name' => 'nullable|string',
                    'email' => 'nullable|string',
                    'phone' => 'nullable|string',
                    'published' => 'nullable|numeric',
                    'photo' => 'nullable|string',
                    'address' => 'nullable|string',
                    'state_id' => 'nullable|numeric',
                    'city_id' => 'nullable|numeric',
                    'discount30' => 'nullable|string',
                    'discount60' => 'nullable|string',
                    'discount90' => 'nullable|string',
                    'discount120' => 'nullable|string',
                ]);

                if($validator->fails()){
                    return response()->json([
                        'status' => false,
                        'message' => 'validation error',
                        'error' => $validator->errors()->first()
                    ], 401);
                }

                if(!$this->checkPin($request)['result']){
                    return response()->json([
                        'status' => false,
                        'message' => 'Invalid Pin',
                    ], 401);
                }

                $shop = Shop::find($request->shop_id);
                if(!$shop){
                    return response()->json([
                        'status' => false,
                        'message' => 'Shop Not found',
                    ], 401);
                }
                $request->name ? $shop->name = $request->name:'';
                $request->email ? $shop->email = $request->email:'';
                $request->phone ? $shop->phone = $request->phone:'';
                $request->published ? $shop->published = $request->published:'';
                if($request->photo){
                    if($request->hasFile('banner')){
                        if($shop->banner) Storage::delete('public/'.$shop->banner);
                        $banner = 'uploads/'.time().'.'.$request->file('banner')->getClientOriginalExtension();
                        $request->file('photo')->storeAs('public/',$banner);
                    }else{
                        $size = getimagesize($request->photo);
                        $extension = image_type_to_extension($size[2]);
                        $banner = 'public/uploads/'.time().'.'.$extension;
                        $contents = file_get_contents($request->photo);
                        Storage::put($banner, $contents);
                    }
                    $shop->banner = $banner;
                } 
                $request->address ? $shop->address = $request->address:'';
                $request->state_id ? $shop->state_id = $request->state_id:'';
                $request->city_id ? $shop->city_id = $request->city_id:'';
                $request->discount30 ? $shop->discount30 = $request->discount30:'';
                $request->discount60 ? $shop->discount60 = $request->discount60:'';
                $request->discount90 ? $shop->discount90 = $request->discount90:'';
                $request->discount120 ? $shop->discount120 = $request->discount120:'';
                $shop->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Successfully Updated Shop',
                ], 200);
        
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    
    }

    public function destroy(Request $request){
        $user = auth()->user();
        try {
            //Validated
            $validator = Validator::make($request->all(), 
            [
                'shop_id' => 'required|numeric',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validator->errors()->first()
                ], 401);
            }
            $shop = Shop::where('id',$request->shop_id)->where('user_id',$user->id)->first();
            if(!$shop){
                return response()->json([
                    'status' => false,
                    'message' => 'Shop Not found',

                ], 401);
            }
            event(new DeleteShop($shop));
            
            return response()->json([
                'status' => true,
                'message' => 'Shop Deleted Successfully',  
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
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
