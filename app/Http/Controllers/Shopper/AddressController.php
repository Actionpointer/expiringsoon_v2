<?php

namespace App\Http\Controllers\Shopper;

use App\Models\State;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{

    public function __construct(){
        $this->middleware('auth:sanctum');
    }
    
    public function index(){
        $user = auth()->user();
        $states = State::where('country_id',$user->country_id)->get();
        return view('customer.address',compact('user','states'));
    }
    
    public function store(Request $request){
        $user= auth()->user();
        if($request->main){
            Address::where('user_id',$user->id)->update(['main'=> 0]);
        }
        $address = Address::create(['user_id'=> auth()->id(),'state_id'=> $request->state_id,'city_id'=> $request->city_id,'street' => $request->street,'contact_phone' => $request->contact_phone,'contact_name' => $request->contact_name ,'main' => $request->main ?? 0]);
        $addresses = Address::where('user_id',$user->id)->get();
        if($addresses->isNotEmpty() && $addresses->where('main',true)->isEmpty()){
            $addresses->first()->main = true;
            $addresses->first()->save();
        }
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Address Added Successfully',
            ], 200) :
            redirect()->back()->with(['result'=> '1','message'=> 'Address Added Successfully']); 
    }


    public function update(Request $request){
        $user= auth()->user();
        if($request->main){
            Address::where('user_id',$user->id)->update(['main'=> 0]);
        }
        $address = Address::where('id',$request->address_id)->update(['state_id'=> $request->state_id,'city_id'=> $request->city_id,'street' => $request->street,'contact_phone' => $request->contact_phone,'contact_name' => $request->contact_name,'main' => $request->main ?? 0]);
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Address Updated Successfully',
        ], 200) :
        redirect()->back()->with(['result'=> '1','message'=> 'Address Updated Successfully']);
    }

    public function destroy(Request $request){
        $user= auth()->user();
        Address::where('id',$request->address_id)->delete();
        $addresses = Address::where('user_id',$user->id)->get();
        if($addresses->isNotEmpty() && $addresses->where('main',true)->isEmpty()){
            $addresses->first()->main = true;
            $addresses->first()->save();
        }
        return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Address Deleted Successfully',
            ], 200) : redirect()->back()->with(['result'=> '1','message'=> 'Address Deleted Successfully']);
    }

}
