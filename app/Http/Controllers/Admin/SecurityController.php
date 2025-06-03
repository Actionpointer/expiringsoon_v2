<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kyc;
use App\Models\User;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;

class SecurityController extends Controller
{
    use GeoLocationTrait;

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $countries = Country::all();
        return view('backend.settings.security',compact('countries'));
    }
    
    public function ip_block(Request $request){
        $location = Location::where('ipaddress',$request->ipaddress)->first();
        if(!$location){
            $result = Curl::to('http://www.geoplugin.net/php.gp?ip='.$request->ipaddress)->get();
            $geo_location =  unserialize($result);
            $location = $this->saveLocation($geo_location);
        }
        if($location){
            $location->status = false;
            $location->save();
        }
        return redirect()->back()->with(['result'=> 1,'message'=> 'Ip address blocked']);
    }

    public function ip_release(Request $request){
        $location = Location::find($request->location_id);
        $location->status = true;
        $location->save();
        return redirect()->back()->with(['result'=> 1,'message'=> 'Ip address released']);
    }

    
    public function verifications(){
        
        $type = 'all';
        $country_id = null;
        $sortBy = null;
        $status = 'all';
        $documents = Kyc::within(); 
        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status');
            if($status == "approved"){
                $documents = $documents->where('status',true);
            }
            if($status == "pending"){
                $documents = $documents->where('status',true);
            }
            if($status == "rejected"){
                $documents = $documents->where('status',true);
            }
           
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $documents = $documents->whereHas('receiver',function($query) use($country_id){
                $query->where('country_id',$country_id);
            });
        }else{
            $country_id = 0;
        }
        if(request()->query() && request()->query('type') && request()->query('type') != 'all'){
            $type = request()->query('type');
            $documents = $documents->where('verifiable_type',$type);
        }
        
        
        if(request()->query() && request()->query('from_date')){
            $from_date = request()->query('from_date');
            $documents = $documents->where('created_at','>=',$from_date);
        }
        if(request()->query() && request()->query('to_date')){
            $to_date = request()->query('to_date');
            $documents = $documents->where('created_at','<=',$to_date);
        }

        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'date_asc'){
                $documents = $documents->orderBy('created_at','asc');
            }
            if(request()->query('sortBy') == 'date_desc'){
                $documents = $documents->orderBy('created_at','desc');
            }
            
        }
        $countries = Country::all();
        
        $documents = $documents->paginate(16);
        $min_date = $documents->total() ? $documents->min('created_at')->format('Y-m-d') : null;
        $max_date = $documents->total() ? $documents->max('created_at')->format('Y-m-d') : null;

        return view('admin.users.kyc',compact('documents','min_date','max_date','countries','country_id','status','type','sortBy'));
    }

    
}
