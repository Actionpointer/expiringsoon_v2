<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{

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
        if($shop && $shop->owner()->id == auth()->id()){
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
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required|max:255',
                'address' => 'required|string',
                'state_id' => 'required|string',
                'city_id' => 'required|string',
                'email' => 'required|string|unique:users',
                'photo' => ['required','string','url','not-regex:(.svg|.gif)']
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors()->first()
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
                'data' => ['shop_id'=> $shop->id,'name'=> $shop->id,'wallet_balance'=> 0,'owner'=> auth()->user(),'products'=> $shop->products->count() ,'create_shops_remaining'=> $shop->owner()->allowedShops()]
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
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required|max:255',
                'address' => 'required|string',
                'state_id' => 'required|string',
                'city_id' => 'required|string',
                'email' => 'required|string|unique:users',
                'phone' => 'required|string|unique:users',
                'photo' => 'required|max:1024|image',
                'published' => 'required|string',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors()->first()
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

    

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
