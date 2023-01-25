<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Kyc;
use App\Models\Bank;
use App\Models\City;
use App\Models\Shop;
use App\Models\User;
use App\Models\State;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
use App\Events\DeleteShop;
use App\Models\ShippingRate;
use App\Events\DeleteProduct;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;
use App\Http\Requests\ShopRequest;
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    // use SecurityTrait;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    public function index(){
        $user = auth()->user();
        return request()->expectsJson() ?  
        response()->json([
            'status' => true,
            'message' => $user->shops->count() ? 'Shops retrieved Successfully':'No Shops retrieved',
            'data' => ShopResource::collection($user->shops),
            'count' => $user->shops->count()
        ], 200) : view('vendor.shop.list',compact('user'));
    }

    public function show(Shop $shop){
        return view('vendor.shop.dashboard',compact('shop'));
    }

    public function details($shop_id){
        $shop = Shop::find($shop_id);
        if($shop && $shop->user_id == auth()->id()){
            return response()->json([
                'status' => true,
                'message' => 'Shop retrieved Successfully',
                'data' => new ShopResource(Shop::find($shop_id))
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Shop does not exist',
                'data' => null,
                'count' => 0
            ], 401);
        }
    }

    public function create(){
        $states = State::all();
        $cities = City::all();
        return view('vendor.shop.create',compact('states','cities'));
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
            $shop = Shop::create(['name'=> $request->name,'user_id'=> $user->id ,'email'=>$request->email,'phone'=>$request->phone,'banner'=>$banner,
            'address'=> $request->address,'country_id'=> $user->country_id ,'state_id'=> $request->state_id,'city_id'=> $request->city_id,'published'=> 1]);
            
            return response()->json([
                'status' => true,
                'message' => 'Shop Created Successfully',
                'data' => ['shop_id'=> $shop->id,'name'=> $shop->id,'wallet_balance'=> 0,'owner'=> auth()->user(),'products'=> $shop->products->count() ,'create_shops_remaining'=> $shop->user->max_shops]
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
                return request()->expectsJson()
                ? response()->json(['status' => false, 'message' => 'validation error', 'error' => $validator->errors()->first() ], 401) :
                redirect()->back()->withErrors($validator)->withInput();
            }

            if($request->hasFile('photo')){
                $banner = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->storeAs('public/',$banner);
            }
            $shop = Shop::create(['name'=> $request->name,'user_id'=> $user->id ,'email'=>$request->email,'phone'=>$request->phone,'banner'=>$banner,
            'address'=> $request->address,'country_id'=> $user->country_id ,'state_id'=> $request->state_id,'city_id'=> $request->city_id,'published'=> $request->published]);
            
            return request()->expectsJson()
                ? response()->json(['status' => true, 'message' => 'Shop Created Successfully', 
                    'data' => ['shop_id'=> $shop->id,'name'=> $shop->id,'wallet_balance'=> 0,
                    'products'=> $shop->products->count() ,
                    'create_shops_remaining'=> $shop->user->max_shops]], 200) :
                    redirect()->route('vendor.shop.settings',$shop)->with(['result'=> 1,'message'=> 'Shop Created Successfully.']);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request){
        $user = auth()->user();
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
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
                    return request()->expectsJson() ?  
                         response()->json(['status' => false,'message' => 'validation error','error' => $validator->errors()->first()],401):
                         redirect()->back()->withErrors($validator)->withInput();
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
                return request()->expectsJson() ?  
                 response()->json([
                    'status' => true,
                    'message' => 'Successfully Updated Shop',
                ], 200) :
                redirect()->back()->with(['result'=> '1','message'=> 'Shop Details Updated Successfully']);
        
    
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

    public function settings(Shop $shop){
        $user = auth()->user();
        $banks = Bank::all();
        $states = State::all();
        $cities = City::where('state_id',$shop->state_id)->get();
        $rates = ShippingRate::where('shop_id',$shop->id)->get();
        return view('vendor.shop.settings',compact('user','shop','banks','states','cities','rates'));
    }

    public function profile(Shop $shop,Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $shop->name = $request->name;
        $shop->email = $request->email;
        $shop->phone = $request->phone;
        $shop->published = $request->published;
        if($request->hasFile('photo')){
            if($shop->banner) Storage::delete('public/'.$shop->banner);
            $banner = 'uploads/'.time().'.'.$request->file('banner')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$banner);
            $shop->banner = $banner;
        } 
        $shop->save();
        
    }

    public function address(Shop $shop,Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $shop->address = $request->address;
        $shop->state_id = $request->state_id;
        $shop->city_id = $request->city_id;
        $shop->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Address Updated Successfully']);
    }

    public function discounts(Shop $shop,Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $shop->discount30 = $request->discount30;
        $shop->discount60 = $request->discount60;
        $shop->discount90 = $request->discount90;
        $shop->discount120 = $request->discount120;
        $shop->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Discount Saved']);
    }

    public function notifications(Shop $shop){
        
    }

    
}
