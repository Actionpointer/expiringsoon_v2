<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop,Request $request)
    {
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
                $user = User::where('id',$request->user_id)->update(['fname'=> explode(' ',$request->name)[0],'lname'=> explode(' ',$request->name)[1],'status'=> $request->status,'email'=> $request->email,'phone_prefix'=> cache('settings')['dialing_code'] ,'phone'=> $request->phone]);
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
            $user = User::create(['fname'=> $request->fname,'lname'=> $request->lname,'role'=> 'vendor','shop_id'=> $shop->id,'email'=> $request->email,'phone_prefix'=> cache('settings')['dialing_code'] ,'phone'=> $request->phone,'password'=> Hash::make($request->password),'state_id'=> $shop->state_id]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'User created successfully']);
        }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
