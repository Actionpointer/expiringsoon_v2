<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kyc;
use App\Models\Bank;
use App\Models\Plan;
use App\Models\Role;
use App\Models\User;
use App\Models\State;
use App\Models\Payout;
use App\Models\Country;
use App\Models\Rejection;
use App\Models\Permission;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\SecurityTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use SecurityTrait;

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('backend.customers.list');
    }


    
    public function customers(){
        
        $country_id = null;
        $sortBy = null;
        $name = null;
        $users = User::within()->whereHas('role',function($query){$query->where('name','shopper');});
        if(request()->query() && request()->query('name')){
            $name = request()->query('name');
            $users = $users->where(function($or) use($name){
                $or->where('fname','LIKE',"%$name%")->orWhere('lname','LIKE',"%$name%");
            });
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $users = $users->where('country_id',$country_id);
        }else{
            $country_id = 0;
        }
        
        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'name_asc'){
                $users = $users->orderBy('fname','asc');
            }
            if(request()->query('sortBy') == 'name_desc'){
                $users = $users->orderBy('fname','desc');
            }
            
        }
        $countries = Country::all();
        $users = $users->paginate(16);
        return view('admin.users.customers',compact('users','countries','country_id','sortBy','name'));
    }

    public function vendors(){
        $category = null;
        $subscription = 0;
        $country_id = null;
        $sortBy = null;
        $name = null;
        $users = User::within()->whereHas('role',function($query){$query->where('name','vendor');});
        if(request()->query() && request()->query('name')){
            $name = request()->query('name');
            $users = $users->where(function($or) use($name){
                $or->where('fname','LIKE',"%$name%")->orWhere('lname','LIKE',"%$name%");
            });
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $users = $users->where('country_id',$country_id);
        }else{
            $country_id = 0;
        }

        if(request()->query() && request()->query('subscription') && request()->query('subscription') != 'all'){
            $subscription = request()->query('subscription');
            $users = $users->whereHas('subscription',function($query) use($subscription){
                $query->where('plan_id',$subscription);
            });
        }
        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'name_asc'){
                $users = $users->orderBy('fname','asc');
            }
            if(request()->query('sortBy') == 'name_desc'){
                $users = $users->orderBy('fname','desc');
            }
            
        }
        
        $plans = Plan::all();
        $countries = Country::all();
        $users = $users->paginate(16);
        return view('admin.users.vendors',compact('users','countries','plans','country_id','subscription','sortBy','name'));
    }

    public function admin(){
        $staff = User::has('is_admin')->get();
        $permissions = Permission::all();
        return view('backend.settings.staff.index',compact('staff','permissions'));
    }

    public function show(User $user){
        return view('backend.customers.view',compact('user'));
    }

    public function manage(Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        if($request->status){
            Rejection::where('rejectable_id',$user->id)->where('rejectable_type','App\Models\User')->delete();
        }else{
            $user->rejected()->create(['reason'=> $request->reason,'rejectable_id'=> $user->id,'rejectable_type' => get_class($user)]);
        }
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
            'password' => 'required','string',
            'country_id' => 'required','string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> $validator->errors()->first()]);
        }
        $state = State::where('country_id',$request->country_id)->first();
        $role_id = Role::where('name',$request->role)->first()->id;
        $user = User::create(['fname'=> $request->fname,'lname'=> $request->lname,'status'=> $request->status,'role_id'=> $role_id,'state_id'=> $state->id,'country_id'=> $request->country_id,'email'=> $request->email,'phone'=> $request->phone,'password'=> Hash::make($request->password)]);
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
        $user = User::where('id',$request->user_id)->update(['fname'=> $request->fname,'lname'=> $request->lname,'status'=> $request->status,'role_id'=> $request->role,'email'=> $request->email,'phone'=> $request->phone]);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Updated User']);
    }

    public function destroy(Request $request){
        $user = User::destroy($request->user_id);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Successfully Deleted User']);
    }

}
