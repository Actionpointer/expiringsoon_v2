<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
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
        $locations = Location::where('status','false')->paginate(10);
        $users = User::all();
        return view('admin.security',compact('locations','users'));
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
        //
    }

    
}
