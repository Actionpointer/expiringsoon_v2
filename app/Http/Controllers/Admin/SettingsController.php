<?php

namespace App\Http\Controllers\Admin;



use App\Models\Cost;
use App\Models\Plan;
use App\Models\Role;
use App\Models\User;
use App\Models\Price;
use App\Models\Adplan;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Currency;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $settings = [];
        return view('backend.settings.index',compact('settings'));
    }

    public function store(Request $request){
        
        foreach($request->except('_token') as $key => $value){
            Setting::where('name',$key)->update(['value'=> $value]);
        }
        Cache::forget('settings');
        $settings = Cache::rememberForever('settings', function () {
            return \App\Models\Setting::select(['name','value'])->get()->pluck('value','name')->toArray();
        });
        return redirect()->back()->with(['result'=> 1,'message'=> 'Settings Saved']);
    }

    public function roles(){
        $roles = Role::paginate(10);
        $permissions = Permission::all();
        return view('backend.settings.roles.index',compact('roles','permissions'));
    }

    public function store_role(Request $request){
        Role::create($request->all());
        return redirect()->back();
    }

    public function update_role(Request $request){
        Role::where('id',$request->role_id)->update($request->except(['role_id','_token']));
        return redirect()->back();
    }

    public function destroy_role(Request $request){
        dd($request->all());
    }
    
    

    
    
    

    
    
    
    
}
