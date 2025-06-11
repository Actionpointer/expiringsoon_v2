<?php

namespace App\Http\Controllers\Vendor;


use App\Models\Kyc;
use App\Models\City;
use App\Models\State;
use App\Models\Store;
use App\Models\Country;
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

class StoreController extends Controller
{
    use SecurityTrait;

    public function store(Request $request){
        $user = auth()->user();
        try {
            //Validated
            $validator = Validator::make($request->all(), 
            [
                'name' => 'required|max:255',
                'description' => 'required|string',
                'email' => 'required|string|unique:stores',
                'phone' => 'required|string|unique:stores',
                'photo' => 'required|max:2048|image',
                'address' => 'required|string',
                'continent' => 'required|string',
                'country' => 'required|string',
                'country_code' => 'required|string',
                'state' => 'required|string',
                'city' => 'required|string',
                
            ],[
                'photo.max' => 'The image is too heavy. Standard size is 2mb',
            ]);

            if($validator->fails()){
                return response()->json(['status' => false, 'message'=>$validator->errors()->first() ], 401);
            }

            // Get or create country
            $country = Country::firstOrCreate(
                ['code' => $request->country_code],
                ['name' => $request->country,'continent' => $request->continent]
            );

            // Get or create state
            $state = State::firstOrCreate(
                [
                    'name' => $request->state,
                    'country_id' => $country->id
                ]
            );

            // Get or create city
            $city = City::firstOrCreate(
                [
                    'name' => $request->city,
                    'state_id' => $state->id
                ]
            );

            $photo = 'stores/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $path = storage_path('app/public/'.$photo);
            $imgFile = Image::make($request->file('photo'));
            // $imgFile->fit(150,150)->save($path);
            $imgFile->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
            
            $store = Store::create(['name'=> $request->name,
            'user_id'=> $user->id ,'email'=>$request->email,
            'phone'=>$request->phone,'photo'=>$photo,
            'address'=> $request->address,
            'country_id'=> $country->id,
            'state_id'=> $state->id,
            'city_id'=> $city->id,
            'published'=> 1]);
            
            // Add the store owner as a workplace member with full permissions
            
            
            return response()->json([
                'status' => true, 
                'message' => 'Store Created Successfully', 
                'data' => [
                    'store_id'=> $store->id,
                    'name'=> $store->name,
                    'wallet_balance'=> 0,
                    'products'=> $store->products->count(),
                ]
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    
    public function index(){
        $user = auth()->user();
        $stores = $user->activeWorkplaces;
        return response()->json([
            'status' => true,
            'message' => $user->activeWorkplaces->count() ? 'Stores retrieved Successfully':'No Stores retrieved',
            'data' => StoreResource::collection($stores),
            'count' => $stores->count()
        ], 200);
    }

    public function show(Store $store){
        if($store){
            //DB::table('notifications')->whereNull('read_at')->where('notifiable_id',$store->user_id)->where('notifiable_type','App\Models\User')->whereJsonContains('data->id',$store->id)->whereJsonContains('data->related_to','shop')->update(['read_at'=> now()]);
            return response()->json([
                'status' => true,
                'message' => 'Store retrieved Successfully',
                'data' => new StoreResource($store)
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Store does not exist',
                'data' => null,
                'count' => 0
            ], 401);
        }
    }

    public function update(Request $request){
        $store = Store::find($request->store_id);
            if(!$store){
                return response()->json([
                    'status' => false,
                    'message' => 'Store Not found',
            ], 404);
        }

        $user = auth()->user();
        
        // Check if user has permission to update this store
        $staffMember = $store->staff()->where('user_id', $user->id)->first();
        if (!$staffMember || !$staffMember->pivot || !in_array('stores', json_decode($staffMember->pivot->permissions, true) ?? [])) {
            return response()->json([
                'status' => false,
                'message' => 'You do not have permission to update this store',
            ], 403);
        }

        try {
            // Validated
            $validator = Validator::make($request->all(), 
            [
                'name' => 'required|max:255',
                'description' => 'required|string',
                'email' => ['required', 'string', Rule::unique('stores')->ignore($store->id)],
                'phone' => ['required', 'string', Rule::unique('stores')->ignore($store->id)],
                'address' => 'required|string',
                'state' => 'required|string',
                'city' => 'required|string',
                'photo' => 'nullable|max:2048|image',
            ],[
                'photo.max' => 'The image is too heavy. Standard size is 2mb',
            ]);

            if($validator->fails()){
                return response()->json(['status' => false, 'message'=>$validator->errors()->first()], 422);
            }

            // Country cannot be changed, use existing country
            $country = Country::find($store->country_id);
            if (!$country) {
                return response()->json([
                    'status' => false,
                    'message' => 'Store country information is invalid',
                ], 500);
            }

            // Get or create state within the same country
            $state = State::firstOrCreate(
                [
                    'name' => $request->state,
                    'country_id' => $country->id
                ]
            );

            // Get or create city
            $city = City::firstOrCreate(
                [
                    'name' => $request->city,
                    'state_id' => $state->id
                ]
            );

            // Update store data
            $storeData = [
                'name' => $request->name,
                'description' => $request->description,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'state_id' => $state->id,
                'city_id' => $city->id
            ];

            // Handle photo upload if provided
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($store->photo && Storage::exists('public/' . $store->photo)) {
                    Storage::delete('public/' . $store->photo);
                }
                
                $photo = 'stores/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
                $path = storage_path('app/public/'.$photo);
            $imgFile = Image::make($request->file('photo'));
            $imgFile->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
            
                $storeData['photo'] = $photo;
            }
            
            // Update the store
            $store->update($storeData);

            // Notify store owner of updates
            $store->owner->notify(new NewStoreNotification($store));
            
            return response()->json([
                'status' => true, 
                'message' => 'Store Updated Successfully', 
                'data' => [
                    'store_id'=> $store->id,
                    'name'=> $store->name,
                    'wallet_balance'=> $store->wallet->balance ?? 0,
                    'products'=> $store->products->count(),
                ]
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
            $photo = 'stores/'.time().'.'.$extension;
            $path = storage_path('app/public/'.$photo);                   
            $imgFile = Image::make(file_get_contents($request->photo));
            $imgFile->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
            $store = Store::create(['name'=> $request->name,'user_id'=> $user->id ,'email'=>$request->email,'phone'=>$request->phone,'photo'=>$photo,
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
                $document = 'stores/'.time().'.'.$file->getClientOriginalExtension();
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
