<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kyc;
use App\Models\Shop;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request; 
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;


class ShopController extends Controller
{
    use SecurityTrait;
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    
    public function index(){
        
        $country_id = null;
        $sortBy = null;
        $name = null;
        $users = Shop::within()->whereHas('role',function($query){$query->where('name','shopper');});
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
        return view('admin.shops.list',compact('shops','countries','country_id','sortBy','name'));
    }


    public function show(Shop $shop){
        return view('admin.shops.view',compact('shop'));
    }

    public function manage(Request $request){
        $shop = Shop::find($request->shop_id);
        $shop->approved = $request->approved;
        $shop->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'Shop Status Updated']);
    }
    
    public function kyc(Request $request){
        $kyc = Kyc::find($request->kyc_id);
        $kyc->status = $request->status;
        $kyc->reason = $request->reason ?? null;
        $kyc->save();
        return redirect()->back()->with(['result'=> '1','message'=> 'KYC Document updated']);

    }
    

    
}
