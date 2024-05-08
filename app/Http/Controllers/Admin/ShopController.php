<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kyc;
use App\Models\Shop;
use App\Models\User;
use App\Models\Country;
use App\Models\Rejection;
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
        $status = 'all';
        $sortBy = null;
        $name = null;
        $shops = Shop::within();
        if(request()->query() && request()->query('name')){
            $name = request()->query('name');
            $shops = $shops->where(function($or) use($name){
                $or->where('name','LIKE',"%$name%")->orWhereHas('user',function($us)use($name){
                    $us->where('fname','LIKE',"%$name%")->orWhere('lname','LIKE',"%$name%");
                });
            });
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $shops = $shops->where('country_id',$country_id);
        }else{
            $country_id = 0;
        }
        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status');
            if($status == 'live')
            $shops = $shops->isApproved()->isVisible()->isActive();
            if($status == 'pending')
            $shops = $shops->where('approved',false);
            if($status == 'rejected'){
            $shops = $shops->has('rejected');
            }
            if($status == 'inactive')
            $shops = $shops->where('status',false);
            if($status == 'draft')
            $shops = $shops->where('published',false);
        }
        
        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'name_asc'){
                $shops = $shops->orderBy('name','asc');
            }
            if(request()->query('sortBy') == 'name_desc'){
                $shops = $shops->orderBy('name','desc');
            }
            
        }
        $countries = Country::all();
        $shops = $shops->paginate(16);
        return view('admin.shops.list',compact('shops','status','countries','country_id','sortBy','name'));
    }


    public function show(Shop $shop){
        return view('admin.shops.view',compact('shop'));
    }

    public function manage(Request $request){
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        $shop = Shop::find($request->shop_id);
        if($request->approved){
            $shop->approved = $request->approved;
            $shop->save();
            Rejection::where('rejectable_id',$shop->id)->where('rejectable_type','App\Models\Shop')->delete();
            return redirect()->back()->with(['result'=> 1,'message'=> 'Shop Approved Successfully']);
        }else{
            $shop->approved = $request->approved;
            $shop->save();
            $shop->rejected()->create(['reason'=> $request->reason,'rejectable_id'=> $shop->id,'rejectable_type' => get_class($shop)]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'Shop Rejected Successfully']);
            
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
