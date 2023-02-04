<?php

namespace App\Http\Controllers\Admin;

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
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use SecurityTrait;

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $users = User::whereIn('role',['shopper','vendor'])->get();
        return request()->expectsJson()
        ? response()->json(['data' => $users], 200)
        : view('admin.users.list',compact('users'));
        
    }

    public function show(User $user){
        return view('admin.users.view',compact('user'));
    }

    public function manage(Request $request){
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'User Status Changed']);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'status' => 'required|numeric',
            'role' => 'required|string',
            'email' => 'required|string|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required','string','confirmed'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> $validator->errors()->first()]);
        }
        $user = User::create(['fname'=> $request->fname,'lname'=> $request->lname,'status'=> $request->status,'role'=> $request->role,'state_id'=> session('locale')['state_id'],'country_id'=> session('locale')['country_id'],'email'=> $request->email,'phone'=> $request->phone,'password'=> Hash::make($request->password)]);
        return redirect()->back()->with(['result'=> 1,'message'=> 'User created successfully']);
    }

    public function update(Request $request){
        $user = User::find($request->user_id);
        $validator = Validator::make($request->all(), [
            'fname' => 'nullable|string',
            'lname' => 'nullable|string',
            'status' => 'nullable|numeric',
            'role' => 'nullable|string',
            'email' => ['nullable',Rule::unique('users')->ignore($user)],
            'phone' => ['nullable',Rule::unique('users')->ignore($user)],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> 'Could not update user']);
        }
        $user = User::where('id',$request->user_id)->update(['fname'=> $request->fname,'lname'=> $request->lname,'status'=> $request->status,'role'=> $request->role,'email'=> $request->email,'phone'=> $request->phone]);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Updated User']);
    }

    public function destroy(Request $request){
        $user = User::destroy($request->user_id);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Deleted User']);
    }

}
