<?php

namespace App\Http\Controllers;

use App\Models\Kyc;
use App\Models\Bank;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Setting;
use App\Models\BankInfo;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile(){
        $user = auth()->user();
        $banks = Bank::all();
        $states = State::all();
        $minThreshold = Setting::where('name','minThreshold')->first()->value;
        return view('customer.profile',compact('user','banks','states','minThreshold'));
    }

    public function update(Request $request){
        // dd($request->all());
        //add validation rules.. phone number should not be existing before
        $user = auth()->user();
        if($request->fname) $user->fname = $request->fname;
        if($request->lname) $user->lname = $request->lname;
        if($request->phone) $user->phone = $request->phone;
        if($request->hasFile('photo')){
            if($user->image) Storage::delete('public/'.$user->pic);
            $name = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$name);
            $user->pic = $name;
        }
        $user->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Profile Updated Successfully']);
    }

    public function topup(Request $request){
        if($url = $this->initializePayment($request->amount)){
            return redirect()->to($url);
        }else
            return redirect()->back()->with(['result'=> '0','message'=> 'Error Processing Payment']);
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

    public function verify($transaction){
        return redirect()->route('home')->with(['result'=> '1','message'=> 'You topped your wallet']);
    }

    
    
    
    
    
    /*
     Admin area
     */

    public function index()
    {
        $users = User::where('role','!=','Administrator')->get();
        return view('admin.users.list',compact('users'));
    }

    

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

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
    public function edit(User $user)
    {
        return view('admin.users.list',compact('user'));
    }


    public function destroy($id)
    {
        //
    }
}
