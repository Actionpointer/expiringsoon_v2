<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Kyc;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\OtpValidateRule;
use Illuminate\Validation\Rule;
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    use SecurityTrait;
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
        return view('vendor.dashboard',compact('user'));
    }
    

    public function orientation(){
        return view('vendor.orientation');
    }

    public function verification(){
        $user = auth()->user(); 
        return view('vendor.verification',compact('user'));
    }

    public function generate_otp(){
        $user = auth()->user();
        $otp = $this->generateOTP($user);
        $result = $this->sendOTP($user,$otp->code);
        return response()->json(['status'=> true ,'data'=> $result['result'],'message'=> $result['message']],200);
    }

    public function pin(Request $request){
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'pin' => 'required|string',
            'otp' => ['required',new OtpValidateRule($request->otp)]
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message' => 'validation error','error' => $validator->errors()->first()],401):
            redirect()->back()
                        ->withErrors($validator)
                        ->withInput()->with(['result'=> '0','message'=> 'PIN operation was not successful!']);
        }
        
        $user->pin = Hash::make($request->pin);
        $user->save();
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Pin operation was successfully completed',
            ], 200) :
             redirect()->back()->with(['result' => '1','message'=>'Pin operation was successfully completed']); //with success
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
                        response()->json(['status' => false,'message' => 'validation error','error' => $validator->errors()->first()],401):
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

    public function index(Shop $shop,Request $request){
        if($request->user_id){
            if($request->delete){
                //detach user from shop
                $user = User::where('id',$request->user_id)->where('shop_id',$shop->id)->delete();
                return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Deleted Staff']);
            }else{
                //update
                $user = User::where('id',$request->user_id)->where('shop_id',$shop->id)->first();
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string',
                    'email' => ['required',Rule::unique('users')->ignore($user)],
                    'phone' => ['required',Rule::unique('users')->ignore($user)],
                    'status' => 'required|numeric'
                ]);
                if($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> $validator->errors()->first()]);
                }
                $user = User::where('id',$request->user_id)->update(['fname'=> explode(' ',$request->name)[0],'lname'=> explode(' ',$request->name)[1],'status'=> $request->status,'email'=> $request->email,'phone'=> $request->phone]);
                return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Updated User']);
            }
        }else{
            //create
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
            $user = User::create(['fname'=> $request->fname,'lname'=> $request->lname,'role'=> 'vendor','shop_id'=> $shop->id,'email'=> $request->email,'phone'=> $request->phone,'password'=> Hash::make($request->password),'state_id'=> $shop->state_id,'country_id'=> $shop->country_id]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'User created successfully']);
        }  
    }

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
