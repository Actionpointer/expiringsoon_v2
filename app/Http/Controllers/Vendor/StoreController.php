<?php

namespace App\Http\Controllers\Vendor;


use App\Models\Kyc;
use App\Models\Bank;
use App\Models\City;
use App\Models\Rate;
use App\Models\Store;
use App\Models\State;
use App\Events\DeleteStore;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;
use App\Http\Traits\SecurityTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\StoreDetailsResource;
use App\Http\Resources\NotificationResource;


class StoreController extends Controller
{
    use SecurityTrait;

    public function __construct(){
        $this->middleware('auth:sanctum');
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
                $path = storage_path('app/public/'.$banner);
                $imgFile = Image::make($request->file('photo'));
                // $imgFile->fit(150,150)->save($path);
                $imgFile->resize(null, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path);
            }
            $store = Store::create(['name'=> $request->name,'user_id'=> $user->id ,'email'=>$request->email,'phone'=>$request->phone,'banner'=>$banner,
            'address'=> $request->address,'country_id'=> $user->country_id ,'state_id'=> $request->state_id,'city_id'=> $request->city_id,'published'=> $request->published]);
            
            return request()->expectsJson()
                ? response()->json(['status' => true, 'message' => 'Store Created Successfully', 
                    'data' => ['shop_id'=> $store->id,'name'=> $store->id,'wallet_balance'=> 0,
                    'products'=> $store->products->count() ,
                    'create_shops_remaining'=> $store->user->max_shops]], 200) :
                    redirect()->route('vendor.shop.settings',$store)->with(['result'=> 1,'message'=> 'Store Created Successfully.']);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    public function index(){
        $user = auth()->user();
        $stores = $user->shops;
        return request()->expectsJson() ?  
        response()->json([
            'status' => true,
            'message' => $user->shops->count() ? 'Stores retrieved Successfully':'No Stores retrieved',
            'data' => StoreResource::collection($stores),
            'count' => $user->shops->count()
        ], 200) : view('vendor.shop.list',compact('user','shops'));
    }

    public function show(Store $store){
        if($store){
            DB::table('notifications')->whereNull('read_at')->where('notifiable_id',$store->user_id)->where('notifiable_type','App\Models\User')->whereJsonContains('data->id',$store->id)->whereJsonContains('data->related_to','shop')->update(['read_at'=> now()]);
            return request()->expectsJson() ?  
            response()->json([
                'status' => true,
                'message' => 'Store retrieved Successfully',
                'data' => new StoreDetailsResource($store)
            ], 200):
            view('vendor.shop.dashboard',compact('shop'));
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Store does not exist',
                'data' => null,
                'count' => 0
            ], 401);
        }
    }

    public function create(){
        $user = auth()->user();
        $states = $user->country->states;
        $cities = $user->country->cities;
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
            $banner = 'uploads/'.time().'.'.$extension;
            $path = storage_path('app/public/'.$banner);                   
            $imgFile = Image::make(file_get_contents($request->photo));
            $imgFile->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
            $store = Store::create(['name'=> $request->name,'user_id'=> $user->id ,'email'=>$request->email,'phone'=>$request->phone,'banner'=>$banner,
            'address'=> $request->address,'country_id'=> $user->country_id ,'state_id'=> $request->state_id,'city_id'=> $request->city_id,'published'=> 1]);
            
            return response()->json([
                'status' => true,
                'message' => 'Store Created Successfully',
                'data' => ['shop_id'=> $store->id,'name'=> $store->id,'wallet_balance'=> 0,'owner'=> auth()->user(),'products'=> $store->products->count() ,'create_shops_remaining'=> $store->user->max_shops]
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    

    public function settings(Store $store){
        $user = auth()->user();
        $states = $store->country->states;
        $cities = City::where('state_id',$store->state_id)->get();
        return view('vendor.shop.settings',compact('user','shop','states','cities'));
    }
    
    public function update(Request $request){
        $store = Store::find($request->shop_id);
        try {
            $validator = Validator::make($request->all(), 
            [
                'shop_id' => 'required|numeric|exists:shops,id',
                // 'pin' => 'required|numeric',
                'name' => 'nullable|string',
                'email' => ['nullable','string',Rule::unique('shops')->ignore($store)],
                'phone' => ['nullable','string',Rule::unique('shops')->ignore($store)],
                'published' => 'nullable|numeric',
                'photo' => 'nullable|max:2048|image',
                'address' => 'nullable|string',
                'state_id' => 'nullable|numeric',
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
            //         'status' => false,gi
            //         'message' => 'Invalid Pin',
            //     ], 401) :
            //     redirect()->back()->with(['result'=> '0','message'=> 'Invalid Pin']);
            // }
            
            $request->name ? $store->name = $request->name:'';
            $request->email ? $store->email = $request->email:'';
            $request->phone ? $store->phone = $request->phone:'';
            $request->published ? $store->published = $request->published:'';
            if($request->photo){
                if($request->hasFile('photo')){
                    if($store->banner) 
                    Storage::delete('public/'.$store->banner);
                    $banner = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
                    $path = storage_path('app/public/'.$banner);
                    $imgFile = Image::make($request->file('photo'));
                    $imgFile->resize(null, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path);
                }else{
                    $size = getimagesize($request->photo);
                    $extension = image_type_to_extension($size[2]);
                    $banner = 'uploads/'.time().'.'.$extension;
                    $path = storage_path('app/public/'.$banner);                   
                    $imgFile = Image::make(file_get_contents($request->photo));
                    $imgFile->resize(null, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path);
                }
                $store->banner = $banner;
            } 
            $request->address ? $store->address = $request->address:'';
            $request->state_id ? $store->state_id = $request->state_id:'';
            $request->city_id ? $store->city_id = $request->city_id:'';
            $request->discount30 ? $store->discount30 = $request->discount30:'';
            $request->discount60 ? $store->discount60 = $request->discount60:'';
            $request->discount90 ? $store->discount90 = $request->discount90:'';
            $request->discount120 ? $store->discount120 = $request->discount120:'';
            $store->save();
            $store->rejections()->delete();
            return request()->expectsJson() ?  
                response()->json([
                'status' => true,
                'message' => 'Successfully Updated Store',
                'data' => new StoreResource($store)
            ], 200) :
            redirect()->back()->with(['result'=> '1','message'=> 'Store Details Updated Successfully']);
    
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
            $store = Store::where('id',$request->shop_id)->where('user_id',$user->id)->first();
            if(!$store){
                return response()->json([
                    'status' => false,
                    'message' => 'Store Not found',

                ], 401);
            }
            event(new DeleteStore($store));
            
            return response()->json([
                'status' => true,
                'message' => 'Store Deleted Successfully',  
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function verification(Store $store){
        $user = auth()->user();
        return view('vendor.shop.verification',compact('user','shop'));
    }

    public function verify(Request $request){
        // dd($request->all());
        $user = auth()->user();
        try {
            
            $validator = Validator::make($request->all(), 
            [
                'shop_id' => 'required|numeric',
                'type' => 'required|string',
                'document.*' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
            ],[
                'document.*.max' => 'The document is too heavy. Standard size is 2mb',
            ]);
            if($validator->fails()){
                return request()->expectsJson() ?  
                    response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
                    redirect()->back()->with(['result'=> 0,'message'=> $validator->errors()->first()]);
            }
            $verifiable_id = $request->shop_id;
            $verifiable_type = 'App\Models\Store';

            foreach($request->file('document') as $file){

                if($card = $user->kyc->where('type','addressproof')->where('verifiable_type',$verifiable_type)->where('verifiable_id',$verifiable_id)->first()){
                    Storage::delete('public/'.$card->document);
                }else{

                }
                $doctype = explode('/',$file->getClientMimeType())[0];
                $document = 'uploads/'.time().'.'.$file->getClientOriginalExtension();
                $file->storeAs('public/',$document);
                $kyc = Kyc::create(['user_id'=> $user->id,'verifiable_id'=> $verifiable_id,
                    'verifiable_type'=> $verifiable_type,'type'=> $request->type,'doctype'=> $doctype,'document'=> $document]);
            }

            
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

    

    public function notifications(Store $store){
        $store->unreadNotifications->markAsRead();
        $notifications = $store->notifications()->orderBy('created_at','desc')->paginate(2);
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => $store->notifications->count() ? 'Notifications retrieved Successfully':'No Notifications retrieved',
                'data' => $store->notifications->sortByDesc('created_at'),
                'count' => $store->notifications->count()
            ], 200) :
            view('vendor.shop.notifications',compact('notifications','shop'));
            
    }
    
        
}
