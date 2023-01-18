<?php

namespace App\Http\Controllers;

use App\Models\Bank;

use App\Models\User;
use App\Models\State;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Rules\OtpValidateRule;
use App\Models\OneTimePassword;
use Illuminate\Validation\Rule;
use App\Http\Traits\SecurityTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use SecurityTrait;

    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    public function profile(){
        $user = auth()->user();
        $banks = Bank::all();
        $states = State::all();
        $countries = Country::all();
        return view('profile',compact('user','banks','states','countries'));
    }

    public function update(Request $request){
        // dd($request->all());
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'fname' => 'nullable|string',
            'lname' => 'nullable|string',
            'phone' => ['nullable','string',Rule::unique('users')->ignore($user)],
            'photo' => 'nullable|max:1024',
            'state_id' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message' => 'validation error','error' => $validator->errors()->first()],401):
            redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->fname) $user->fname = $request->fname;
        if($request->lname) $user->lname = $request->lname;
        if($request->state_id) $user->state_id = $request->state_id;
        if($request->phone) $user->phone = $request->phone;
        if($request->hasFile('photo')){
            if($user->pic) Storage::delete('public/'.$user->pic);
            $name = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$name);
            $user->pic = $name;
        }
        $user->save();
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Profile Updated Successfully',
            ], 200) :
            redirect()->back()->with(['result'=> '1','message'=> 'Profile Updated Successfully']);
    }

    public function password(Request $request){
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required|string',
            'password' => 'required','string','confirmed'
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message' => 'validation error','error' => $validator->errors()->first()],401):
            redirect()->back()->withErrors($validator)->with(['result'=> '0','message'=> 'Incorrect Password']);
        }
        if(Hash::check($request->oldpassword, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Password Updated Successfully',
            ], 200) :
            redirect()->back()->with(['result' => '1','message'=>'Password changed successfully']); //with success
        }
        else {
            return request()->expectsJson() ? 
            response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ], 401) :
            redirect()->back()->with(['result' => '1','message'=>'Something went wrong']);
        }
    }

    public function generate_otp(){
        $user = auth()->user();
        $otp = OneTimePassword::where('user_id',auth()->id())->whereBetween('created_at',[now()->subMinutes(cache('settings')['throttle_otp_time']),now()])->latest()->first();
        if(!$otp){
            $otp = OneTimePassword::create(['user_id'=> $user->id,'code'=> strtoupper(substr(uniqid(),4,6))]);
        }
        $result = $this->checkOTP($otp->code);
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

    public function address(Request $request){
        $user= auth()->user();
        if($request->main){
            Address::where('user_id',$user->id)->update(['main'=> 0]);
        }
        if($request->address_id){
            if($request->delete){
                Address::where('id',$request->address_id)->delete();
            }else{
                $address = Address::where('id',$request->address_id)->update(['state_id'=> $request->state_id,'city_id'=> $request->city_id,'street' => $request->street,'contact_phone' => $request->contact_phone,'contact_name' => $request->contact_name,'main' => $request->main ?? 0]);
            }
           
        }else{
            $address = Address::create(['user_id'=> auth()->id(),'state_id'=> $request->state_id,'city_id'=> $request->city_id,'street' => $request->street,'contact_phone' => $request->contact_phone,'contact_name' => $request->contact_name ,'main' => $request->main ?? 0]);
        }
        $addresses = Address::where('user_id',$user->id)->get();
        if($addresses->isNotEmpty() && $addresses->where('main',true)->isEmpty()){
            $addresses->first()->main = true;
            $addresses->first()->save();
        }
        return redirect()->back();
    }

    public function notifications(){
        
    }

}
