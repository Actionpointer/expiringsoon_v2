<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Kyc;
use App\Models\Bank;
use App\Models\Role;
use App\Models\Store;
use App\Models\User;
use App\Models\Order;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\PayoutTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Notifications\StoreNotification\NewStaffNotification;

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
        DB::table('notifications')->whereNull('read_at')->where('notifiable_id',$user->id)->where('notifiable_type','App\Models\User')->whereJsonContains('data->related_to','user')->update(['read_at'=> now()]);
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
                'document.*' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:4096',
            ]);
            if($validator->fails()){
                return request()->expectsJson() ?  
                    response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
                    redirect()->back()->with(['result'=> '0','message'=> $validator->errors()->first()]);
            }
            foreach($request->file('document') as $file){
                $doc_type = explode('/',$file->getClientMimeType())[0];
                $document = 'uploads/'.time().'.'.$file->getClientOriginalExtension();
                if($user_idcard = $user->kyc->where('type','idcard')->first()){
                    Storage::delete('public/'.$user_idcard->document);
                    $user_idcard->delete();
                }
                $kyc = Kyc::create(['user_id' => $user->id,'verifiable_id'=> $user->id,'verifiable_type'=> 'App\Models\User','type'=> 'idcard',
                'doctype'=> $doc_type,'document'=> $document]);
                $file->storeAs('public/',$document);
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
        if($user->country->payout_gateway == 'flutterwave'){
            $user->payout_account = $bank->name.'-'.$request->account_number;
            $user->save();
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
        $user = User::create(['fname'=> $request->fname,'lname'=> $request->lname,'role_id'=> $role_id,'shop_id'=> $shop->id,'email'=> $request->email,'email_verified_at'=> now(),'phone'=> $request->phone,'password'=> Hash::make($request->password),
        'state_id'=> $shop->state_id,'country_id'=> $shop->country_id,'require_password_change'=> true]);
        $user->notify(new NewStaffNotification($request->password));
        return redirect()->back()->with(['result'=> 1,'message'=> 'Staff created successfully']);
       
    }

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

}
