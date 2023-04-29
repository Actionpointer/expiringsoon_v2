<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Kyc;
use App\Models\Bank;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\PayoutTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewStaffNotification;
use App\Http\Resources\NotificationResource;

class StaffController extends Controller
{
    use PayoutTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    public function dashboard(){

        $user = auth()->user(); 
        $orders = Order::whereHas('statuses')->whereHas('shop',function($query) use($user){
            $query->where('user_id',$user->id);
        })->get();
        return view('vendor.dashboard',compact('user','orders'));
    }
    

    public function orientation(){
        return view('vendor.orientation');
    }

    public function verification(){
        $user = auth()->user(); 
        return view('vendor.verification',compact('user'));
    }

    public function kyc(Request $request){
        // dd($request->all());
        $user = auth()->user();
        try {
            
                $validator = Validator::make($request->all(), 
                [
                    'shop_id' => [Rule::requiredIf(in_array($request->type,['addressproof','companydoc'])),'numeric'],
                    'type' => 'required|string',
                    'document' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:4096',
                ]);
                if($validator->fails()){
                    return request()->expectsJson() ?  
                        response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
                        redirect()->back()->withErrors($validator)->withInput();
                }
                
                $verifiable_id = $request->type == 'idcard' ?  $user->id : $request->shop_id;
                $verifiable_type = $request->type == 'idcard' ?  'App\Models\User' : 'App\Models\Shop';
                if($request->type == 'idcard' && $user_idcard = $user->kyc->where('type','idcard')->first()){
                    Storage::delete('public/'.$user_idcard->document);
                }
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

    public function banking(){
        $user = auth()->user(); 
        $banks = Bank::within()->get();
        return view('vendor.banking',compact('user','banks')); 
    }

    public function accountNumberResolve(Request $request){
       
        $validator = Validator::make($request->all(), [
            'bank_code' => 'required|string',
            'account_number' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['result'=> 0,'message'=> $validator->errors()->first()],401);
        }
        if(in_array(auth()->user()->country->iso,['NG','GH'])){
            $response = $this->verifybankaccount($request->bank_code,$request->account_number);
            return response()->json(
                ['status' => $response ? $response : false,
                'message' => $response ? 'Account fetched Successfully':'Unable to verify bank account',
                'data' => $response ? $response : false
                ],200);
        }else{
            return response()->json(
                ['status' => true,
                'message' => 'Not applicable',
                'data' => 'Not available'
                ],200);
        }

    }

    public function bank_info(Request $request){
        $validator = Validator::make($request->all(), [
            'branch_id' => [Rule::requiredIf(session('locale')['country_iso'] =='GH'),'string'],
            'bank_id' => 'required|string',
            'account_number' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> $validator->errors()->first()]);
        }
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $bank = Bank::find($request->bank_id);
        if($user->country->payout_gateway == 'paystack'){
            $result = $this->createRecipient($bank->code,$request->account_number);
            if(!$result){
                return redirect()->back()->with(['result'=> '0','message'=> 'Bank details could not be saved']);
            }else{
                $user->payout_account = $result;
                $user->save();
            }
        }
        
        $account = Account::updateOrCreate(['user_id'=> $user->id],['account_number'=> $request->account_number,'bank_id'=>$request->bank_id,'branch_id'=> $request->branch_id ?? null ,'status'=> true]);
        
        return redirect()->back()->with(['result'=> '1','message'=> 'Bank details Updated']);
    }

    public function store(Shop $shop,Request $request){
        // add staff should send an email to the person
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|string|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required','string','confirmed'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> 'Could not create user']);
        }
        $role_id = Role::where('name','staff')->first()->id;
        $user = User::create(['fname'=> $request->fname,'lname'=> $request->lname,'role_id'=> $role_id,'shop_id'=> $shop->id,'email'=> $request->email,'phone'=> $request->phone,'password'=> Hash::make($request->password),
        'state_id'=> $shop->state_id,'country_id'=> $shop->country_id,'require_password_change'=> true]);
        $user->notify(new NewStaffNotification($request->password));
        return redirect()->back()->with(['result'=> 1,'message'=> 'Staff created successfully']);
       
    }

    // public function index($shop_id){
    //     $shop = Shop::find($shop_id);
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Shop Staff retrieved Successfully',
    //         'data' => UserResource::collection($shop->staff),
    //     ], 200);
    // }

    public function update(Shop $shop,Request $request){
        $validator = Validator::make($request->all(), [
            'status' => 'required|numeric'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> $validator->errors()->first()]);
        }
        $user = User::where('id',$request->user_id)->where('shop_id',$shop->id)->first();
        $user->status = $request->status;
        $user->save(); 
        return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Updated Staff']);
    }

    public function destroy(Shop $shop,Request $request){
        $user = User::where('id',$request->user_id)->where('shop_id',$shop->id)->delete();
        return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Deleted Staff']);
    }

    public function notifications(){
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $notifications = $user->notifications()->orderBy('created_at','desc')->paginate(10);
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => $user->notifications->count() ? 'Notifications retrieved Successfully':'No Notifications retrieved',
                'data' => NotificationResource::collection($user->notifications),
                'count' => $user->notifications->count()
            ], 200) :
            view('vendor.notifications',compact('user','notifications'));
    }

    public function readNotifications(Request $request){
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => 'Notifications marked read',
            ], 200) :
            redirect()->back()->with(['result'=> 1,'message'=> 'Notifications marked read']);
    }
}
