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

}
