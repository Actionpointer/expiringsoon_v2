<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kyc;
use App\Models\Store;
use App\Models\User;
use App\Models\Country;
use App\Models\Rejection;
use Illuminate\Http\Request; 
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;


class StoreController extends Controller
{
    use SecurityTrait;
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    
    public function index(){
        
        $country_id = null;
        $status = 'all';
        $sortBy = null;
        $name = null;
        $stores = Store::where('approved',true);
        if(request()->query() && request()->query('name')){
            $name = request()->query('name');
            $stores = $stores->where(function($or) use($name){
                $or->where('name','LIKE',"%$name%")->orWhereHas('user',function($us)use($name){
                    $us->where('fname','LIKE',"%$name%")->orWhere('lname','LIKE',"%$name%");
                });
            });
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $stores = $stores->where('country_id',$country_id);
        }else{
            $country_id = 0;
        }
        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status');
            if($status == 'live')
            $stores = $stores->isApproved()->isVisible()->isActive();
            if($status == 'pending')
            $stores = $stores->where('approved',false);
            if($status == 'rejected'){
            $stores = $stores->has('rejected');
            }
            if($status == 'inactive')
            $stores = $stores->where('status',false);
            if($status == 'draft')
            $stores = $stores->where('published',false);
        }
        
        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'name_asc'){
                $stores = $stores->orderBy('name','asc');
            }
            if(request()->query('sortBy') == 'name_desc'){
                $stores = $stores->orderBy('name','desc');
            }
            
        }
        $countries = Country::all();
        $stores = $stores->paginate(16);
        return view('backend.stores.list',compact('stores','status','countries','country_id','sortBy','name'));
    }


    public function show(Store $store){
        return view('backend.stores.view',compact('store'));
    }

    public function manage(Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $store = Store::find($request->store_id);
        if($request->approved){
            $store->approved = $request->approved;
            $store->save();
            Rejection::where('rejectable_id',$store->id)->where('rejectable_type','App\Models\Store')->delete();
            return redirect()->back()->with(['result'=> 1,'message'=> 'Store Approved Successfully']);
        }else{
            $store->approved = $request->approved;
            $store->save();
            $store->rejected()->create(['reason'=> $request->reason,'rejectable_id'=> $store->id,'rejectable_type' => get_class($store)]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'Store Rejected Successfully']);
            
        }
    }
    
    public function kyc(Request $request){
        //dd($request->all());
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $kyc = Kyc::find($request->kyc_id);
        $kyc->status = $request->status;
        $kyc->save();
        if($request->reason){
            $kyc->rejected()->create(['reason'=> $request->reason,'rejectable_id'=> $kyc->id,'rejectable_type' => get_class($kyc)]);
        }else{
            $kyc->rejected()->delete();
        }
        
        return redirect()->back()->with(['result'=> '1','message'=> 'KYC Document updated']);

    }
    

    
}
