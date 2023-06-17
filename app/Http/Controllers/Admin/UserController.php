<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kyc;
use App\Models\Bank;
use App\Models\Plan;
use App\Models\User;
use App\Models\Order;
use App\Models\State;
use App\Models\Payout;
use App\Models\Address;
use App\Models\Country;
use App\Models\OrderStatus;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Rules\OtpValidateRule;
use App\Models\OneTimePassword;
use Illuminate\Validation\Rule;
use App\Http\Traits\SecurityTrait;
use Illuminate\Support\Facades\DB;
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

    public function dashboard(){
        $processing = cache('settings')['order_processing_to_auto_cancel_period'];
        $shipping = cache('settings')['order_processing_to_delivery_period'] - cache('settings')['order_processing_to_shipment_period'];
        $user = auth()->user();
        DB::table('notifications')->whereNull('read_at')->where('notifiable_id',$user->id)->where('notifiable_type','App\Models\User')->whereJsonContains('data->related_to','user')->update(['read_at'=> now()]);
        $documents = Kyc::within()->where('status',false)->whereNull('reason')->take(5)->get(); 
        $statuses = OrderStatus::within()->where(function($query) use($processing,$shipping){
                        $query->where('name','processing')->where('created_at','<',now()->subHours($processing))
                            ->orWhere('name','shipped')->where('created_at','<',now()->subHours($shipping))
                            ->orWhere('name','ready')->where('created_at','<',now()->subHours(24));
                        })->latest()->take(5)->get();   
        $payouts = Payout::within()->where('status','pending')->orderBy('created_at','asc')->take(5)->get();   
        return view('admin.dashboard',compact('user','documents','statuses','payouts'));
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

    public function staff(){
        $roles = ['admin','manager','customercare','auditor','arbitrator'];
        $users = User::within()->whereHas('role',function($query)use($roles){$query->whereIn('name',$roles);})->paginate(10);
        $countries = Country::all();
        return view('admin.users.staff',compact('users','countries','roles'));
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
            'password' => 'required','string',
            'country_id' => 'required','string'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['result'=> 0,'message'=> $validator->errors()->first()]);
        }
        $state = State::where('country_id',$request->country_id)->first();
        $user = User::create(['fname'=> $request->fname,'lname'=> $request->lname,'status'=> $request->status,'role'=> $request->role,'state_id'=> $state->id,'country_id'=> $request->country_id,'email'=> $request->email,'phone'=> $request->phone,'password'=> Hash::make($request->password)]);
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
