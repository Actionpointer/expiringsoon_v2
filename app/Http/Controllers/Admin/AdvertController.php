<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\Shop;
use App\Models\Adset;
use App\Models\State;
use App\Models\Adplan;
use App\Models\Advert;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rejection;
use Illuminate\Http\Request;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;

class AdvertController extends Controller
{
    use GeoLocationTrait,PaymentTrait;

    public function __construct(){
        $this->middleware('auth')->except('redirect');
    }

    public function index(){
        $type = 'all';
        $country_id = null;
        $sortBy = null;
        $status = 'all';
        $adverts = Advert::within();
        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status');
            if($status == 'live'){
                $adverts = $adverts->running()->where(function($query){
                            $query->whereHas('shop', function ($qry)  { 
                                $qry->isActive()->isApproved()->isVisible()->whereHas('products',function($q){
                                    $q->isValid()->isAccessible()->isAvailable()->isActive()->isApproved()->isVisible();
                                });
                            })->orwhereHas('product', function ($qxy){ 
                                $qxy->isValid()->isApproved()->isActive()->isVisible()->isAccessible()->isAvailable();
                            });
                });
            }
            if($status == 'pending'){
                $adverts = $adverts->where('approved',false);
            }
            if($status == 'rejected'){
                $adverts = $adverts->has('rejected');
            }
            if($status == 'inactive'){
                $adverts = $adverts->running()->whereHas('advertable',function($query){
                    $query->isNotCertified();
                });
            }  
            if($status == 'expired'){
                $adverts = $adverts->whereHas('adset', function ($qry){ 
                    $qry->where('status',false)->orWhere('end_at','>',now()); });
            }
        }

        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $adverts = $adverts->whereHas('user',function($quement) use($country_id){
                $quement->where('country_id',$country_id);
            });
        }else{
            $country_id = 0;
        }

        if(request()->query() && request()->query('type') && request()->query('type') != 'all'){
            $type = request()->query('type');
            $item = 'App\Models\\'.$type;
            $adverts = $adverts->where('advertable_type',$item);
        }
        if(request()->query() && request()->query('from_date')){
            $from_date = request()->query('from_date');
            $adverts = $adverts->where('created_at','>=',$from_date);
        }
        if(request()->query() && request()->query('to_date')){
            $to_date = request()->query('to_date');
            $adverts = $adverts->where('created_at','<=',$to_date);
        }


        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'date_asc'){
                $adverts = $adverts->orderBy('created_at','asc');
            }
            if(request()->query('sortBy') == 'date_desc'){
                $adverts = $adverts->orderBy('created_at','desc');
            }
        }

        $countries = Country::all();
        $adverts = $adverts->paginate(16);
        $min_date = $adverts->total() ? $adverts->min('created_at')->format('Y-m-d') : null;
        $max_date = $adverts->total() ? $adverts->max('created_at')->format('Y-m-d') : null;
        
        return view('admin.adverts.ads',compact('adverts','min_date','max_date','countries','country_id','status','type','sortBy'));
    }

    public function manage(Request $request){
        /** @var \App\Models\User $user **/             
        $user = auth()->user(); 
        $advert = Advert::find($request->advert_id);
        if($request->delete && $user->isRole('superadmin')){
            $advert->delete();
            return redirect()->back()->with(['result'=> 1,'message'=> 'Advert Deleted Successfully']);
        }elseif($request->approved){
            $advert->approved = $request->approved;
            $advert->save();
            Rejection::where('rejectable_id',$advert->id)->where('rejectable_type','App\Models\Advert')->delete();
            return redirect()->back()->with(['result'=> 1,'message'=> 'Advert Updated Successfully']);
        }else{
            $advert->approved = false;
            $advert->save();
            $advert->rejected()->create(['reason'=> $request->reason,'rejectable_id'=> $advert->id,'rejectable_type' => get_class($advert)]);
            
            return redirect()->back()->with(['result'=> 1,'message'=> 'Advert Rejected Successfully']);
            
        }
    }

    public function adsets(){
        $type = 'all';
        $country_id = null;
        $sortBy = null;
        $status = 'all';
        $adsets = Adset::within()->where('status',true);
        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status');
            if($status == 'active'){
                $adsets = $adsets->where('start_at','<',now())->where('end_at','>',now());
            }
            if($status == 'expired'){
                $adsets = $adsets->where('start_at','<',now())->where('end_at','<',now());
            }
        }

        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $adsets = $adsets->whereHas('user',function($quement) use($country_id){
                $quement->where('country_id',$country_id);
            });
        }else{
            $country_id = 0;
        }

        if(request()->query() && request()->query('type') && request()->query('type') != 'all'){
            $type = request()->query('type');
            $adsets = $adsets->where('adplan_id',$type);
        }

        if(request()->query() && request()->query('from_date')){
            $from_date = request()->query('from_date');
            $adsets = $adsets->where('start_at','>=',$from_date);
        }
        if(request()->query() && request()->query('to_date')){
            $to_date = request()->query('to_date');
            $adsets = $adsets->where('end_at','<=',$to_date);
        }


        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'date_asc'){
                $adsets = $adsets->orderBy('created_at','asc');
            }
            if(request()->query('sortBy') == 'date_desc'){
                $adsets = $adsets->orderBy('created_at','desc');
            }
        }

        $countries = Country::all();
        $adplans = Adplan::all();
        $adsets = $adsets->paginate(16);
        $min_date = $adsets->total() ? $adsets->min('created_at')->format('Y-m-d') : null;
        $max_date = $adsets->total() ? $adsets->max('created_at')->format('Y-m-d') : null;
        
        return view('admin.adverts.sets',compact('adsets','adplans','min_date','max_date','countries','country_id','status','type','sortBy'));
    }



}