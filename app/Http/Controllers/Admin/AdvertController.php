<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\Shop;
use App\Models\Adset;
use App\Models\State;
use App\Models\Adplan;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
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
        $adverts = Advert::within()->paginate(10);
        return view('admin.adverts.ads',compact('adverts'));
    }

    public function manage(Request $request){
        $advert = Advert::find($request->advert_id);
        if($request->delete){
            $advert->delete();
            return redirect()->back()->with(['result'=> 1,'message'=> 'Advert Deleted Successfully']);
        }else{
            $advert->approved = $request->approved;
            $advert->save();
            return redirect()->back()->with(['result'=> 1,'message'=> 'Advert Updated Successfully']);
        }
    }

    public function adsets(){
        $adsets = Adset::within()->paginate(10);
        return view('admin.adverts.sets',compact('adsets'));
    }



}