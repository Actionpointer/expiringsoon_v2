<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\State;
use App\Models\Address;
use App\Models\Country;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
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
        $validator = Validator::make($request->all(), [
            'fname' => 'nullable|string',
            'lname' => 'nullable|string',
            'phone' => 'nullable|string|unique:users',
            'photo' => 'nullable|max:1024',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        if($request->fname) $user->fname = $request->fname;
        if($request->lname) $user->lname = $request->lname;
        if($request->phone) {
            $user->phone_prefix = $request->code;
            $user->phone = intval($request->phone);
        }
        if($request->hasFile('photo')){
            if($user->image) Storage::delete('public/'.$user->pic);
            $name = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$name);
            $user->pic = $name;
        }
        $user->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Profile Updated Successfully']);
    }

    public function password(Request $request){
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required|string',
            'password' => 'required','string','confirmed'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()->with(['result'=> '0','message'=> 'Incorrect Password']);
        }
        if(Hash::check($request->oldpassword, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with(['result' => '1','message'=>'Password changed successfully']); //with success
        }
        else return redirect()->back()->with(['result' => '1','message'=>'Something went wrong']);
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

    /*
     Admin area
     */

    public function users(){
        $users = User::whereIn('role',['shopper','vendor'])->get();
        // dd($users);
        return view('admin.users.list',compact('users'));
    }
    public function user_show(User $user){
        return view('admin.users.view',compact('user'));
    }
    public function user_manage(Request $request){
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'User Status Changed']);
    }

}
