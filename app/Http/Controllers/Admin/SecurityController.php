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
    public function index()
    {
        $locations = Location::where('status','false')->paginate(10);
        $users = User::all();
        return view('admin.security',compact('locations','users'));
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
    public function ip_block(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ip_release(Request $request)
    {
        $location = Location::find($request->location_id);
        $location->status = true;
        $location->save();
        return redirect()->back()->with(['result'=> 1,'message'=> 'Ip address released']);
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
