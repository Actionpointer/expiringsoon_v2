<?php

namespace App\Http\Controllers\Vendor;


use App\Models\Kyc;
use App\Models\Bank;
use App\Models\City;
use App\Models\Rate;
use App\Models\Shop;
use App\Models\State;
use App\Events\DeleteShop;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;
use App\Http\Traits\SecurityTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ShopDetailsResource;
use App\Http\Resources\NotificationResource;

class ShopController extends Controller
{
    use SecurityTrait;

    public function __construct(){
        $this->middleware('auth:sanctum');
    }
    
    public function index(){
        $user = auth()->user();
        $shops = $user->shops;
        return request()->expectsJson() ?  
        response()->json([
            'status' => true,
            'message' => $user->shops->count() ? 'Shops retrieved Successfully':'No Shops retrieved',
            'data' => ShopResource::collection($shops),
            'count' => $user->shops->count()
        ], 200) : view('vendor.shop.list',compact('user','shops'));
    }

    public function show(Shop $shop){
        if($shop){
            DB::table('notifications')->whereNull('read_at')->where('notifiable_id',$shop->user_id)->where('notifiable_type','App\Models\User')->whereJsonContains('data->id',$shop->id)->whereJsonContains('data->related_to','shop')->update(['read_at'=> now()]);
            return request()->expectsJson() ?  
            response()->json([
                'status' => true,
                'message' => 'Shop retrieved Successfully',
                'data' => new ShopDetailsResource($shop)
            ], 200):
            view('vendor.shop.dashboard',compact('shop'));
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
                'email' => 'required|string|unique:shops',
                'phone' => 'required|string|unique:shops',
                'photo' => ['required','string','url','not-regex:(.svg|.gif)']
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message'=> $validator->errors()->first()
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
                'email' => 'required|string|unique:shops',
                'phone' => 'required|string|unique:shops',
                'photo' => 'required|max:2048|image',
                'published' => 'required|numeric',
            ],[
                'photo.max' => 'The image is too heavy. Standard size is 2mb',
            ]);

            if($validator->fails()){
                return request()->expectsJson()
                ? response()->json(['status' => false, 'message'=>$validator->errors()->first() ], 401) :
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

    public function settings(Shop $shop){
        $user = auth()->user();
        $banks = Bank::all();
        $states = $shop->country->states;
        $cities = City::where('state_id',$shop->state_id)->get();
        $rates = Rate::where('shop_id',$shop->id)->get();
        return view('vendor.shop.settings',compact('user','shop','banks','states','cities','rates'));
    }
    
    public function update(Request $request){
        $shop = Shop::find($request->shop_id);
        try {
            $validator = Validator::make($request->all(), 
            [
                'shop_id' => 'required|numeric|exists:shops,id',
                // 'pin' => 'required|numeric',
                'name' => 'nullable|string',
                'email' => ['nullable','string',Rule::unique('shops')->ignore($shop)],
                'phone' => ['nullable','string',Rule::unique('shops')->ignore($shop)],
                'published' => 'nullable|numeric',
                'photo' => 'nullable|max:2048|image',
                'address' => 'nullable|string',
                'state_id' => 'nullable|numeric',
                'city_id' => 'nullable|numeric',
                'discount30' => 'nullable|string',
                'discount60' => 'nullable|string',
                'discount90' => 'nullable|string',
                'discount120' => 'nullable|string',
            ],[
                'photo.max' => 'The image is too heavy. Standard size is 2mb',
            ]);

            if($validator->fails()){
                return request()->expectsJson() ?  
                        response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
                        redirect()->back()->withErrors($validator)->withInput()->with(['result'=> '0','message'=> $validator->errors()->first()]);
            }
            // if(!$this->checkPin($request)['result']){
            //     return request()->expectsJson() ?  
            //      response()->json([
            //         'status' => false,
            //         'message' => 'Invalid Pin',
            //     ], 401) :
            //     redirect()->back()->with(['result'=> '0','message'=> 'Invalid Pin']);
            // }
            
            $request->name ? $shop->name = $request->name:'';
            $request->email ? $shop->email = $request->email:'';
            $request->phone ? $shop->phone = $request->phone:'';
            $request->published ? $shop->published = $request->published:'';
            if($request->photo){
                if($request->hasFile('photo')){
                    if($shop->banner) 
                    Storage::delete('public/'.$shop->banner);
                    $banner = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
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
                'data' => new ShopResource($shop)
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
                    'message'=> $validator->errors()->first()
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

    public function verification(Request $request){
        // dd($request->all());
        $user = auth()->user();
        try {
            
            $validator = Validator::make($request->all(), 
            [
                'shop_id' => 'required|numeric',
                'type' => 'required|string',
                'document' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:4096',
            ]);
            if($validator->fails()){
                return request()->expectsJson() ?  
                    response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
                    redirect()->back()->with(['result'=> 0,'message'=> $validator->errors()->first()]);
            }
                
            $verifiable_id = $request->shop_id;
            $verifiable_type = 'App\Models\Shop';
            if($card = $user->kyc->where('type',$request->type)->where('verifiable_type',$verifiable_type)->where('verifiable_id',$verifiable_id)->first()){
                Storage::delete('public/'.$card->document);
            }
            
            $doctype = explode('/',$request->file('document')->getClientMimeType())[0];
                // dd($doctype);
            $document = 'uploads/'.time().'.'.$request->file('document')->getClientOriginalExtension();
            $request->file('document')->storeAs('public/',$document);
            $kyc = Kyc::updateOrCreate(['user_id'=> $user->id,'verifiable_id'=> $verifiable_id,
                'verifiable_type'=> $verifiable_type,'type'=> $request->type],['doctype'=> $doctype,'document'=> $document]);
            return request()->expectsJson() ?  
                    response()->json(['status' => true,'message' => 'Verification Document Saved'],200):   
                    redirect()->back()->with(['result'=> '1','message'=> 'Verification Document Saved']);
        }catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function notifications(Shop $shop){
        $shop->unreadNotifications->markAsRead();
        $notifications = $shop->notifications()->orderBy('created_at','desc')->paginate(2);
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => $shop->notifications->count() ? 'Notifications retrieved Successfully':'No Notifications retrieved',
                'data' => $shop->notifications->sortByDesc('created_at'),
                'count' => $shop->notifications->count()
            ], 200) :
            view('vendor.shop.notifications',compact('notifications','shop'));
            
    }
    
        
}
