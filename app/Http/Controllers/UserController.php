<?php

namespace App\Http\Controllers;

use App\Models\Bank;


use App\Models\State;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Rules\OtpValidateRule;
use Illuminate\Validation\Rule;
use App\Http\Traits\SecurityTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ShopResource;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
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
        $states = State::where('country_id',$user->country_id)->get();
        return view('profile',compact('user','banks','states'));
    }

    public function update(Request $request){
        /** @var \App\Models\User $user **/
        // dd($request->all());
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'fname' => 'nullable|string',
            'lname' => 'nullable|string',
            'phone' => ['nullable','string',Rule::unique('users')->ignore($user)],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'state_id' => 'nullable|numeric',
            'city_id' => 'nullable',
        ],[
            'photo.max' => 'The image is too heavy. Standard size is 2mb',
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
            redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->fname) $user->fname = $request->fname;
        if($request->lname) $user->lname = $request->lname;
        if($request->state_id) $user->state_id = $request->state_id;
        if($request->city_id) $user->city_id = $request->city_id;
        if($request->phone) $user->phone = $request->phone;
        if($request->hasFile('photo')){
            if($user->pic) Storage::delete('public/'.$user->pic);
            $photo = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $path = storage_path('app/public/'.$photo);
            $imgFile = Image::make($request->file('photo'));
            $imgFile->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
            $user->pic = $photo;
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
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required|string',
            'password' => 'required','string','confirmed'
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
            redirect()->back()->withErrors($validator)->with(['result'=> '0','message'=> 'Incorrect Password']);
        }
        if(Hash::check($request->oldpassword, $user->password)){
            $user->password = Hash::make($request->password);
            $user->require_password_change = false;
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
                'message' => 'Your old Password Does not Match',
            ], 401) :
            redirect()->back()->with(['result' => '1','message'=>'Something went wrong']);
        }
    }

    public function generate_otp(){
        $user = auth()->user();
        $otp = $this->generateOTP($user);
        $result = $this->sendOTP($user,$otp->code);
        return response()->json(['status'=> true ,'data'=> $result['result'],'message'=> $result['message']],200);
    }

    public function pin(Request $request){
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'pin' => 'required|string|max:4|min:4',
            'otp' => ['required',new OtpValidateRule($request->otp)]
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
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

    public function notifications(){
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $notifications = $user->notifications()->orderBy('created_at','desc')->paginate(10);
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => $user->notifications->count() ? 'Notifications retrieved Successfully':'No Notifications retrieved',
                'data' => $user->notifications->sortByDesc('created_at'),
                'count' => $user->notifications->count()
            ], 200) :
            view('customer.notifications',compact('user','notifications'));
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

    public function followings(){
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'data' => ShopResource::collection($user->following),
            ], 200) :
            view('customer.following');
    }

}
