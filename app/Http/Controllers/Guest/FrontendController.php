<?php

namespace App\Http\Controllers\Guest;

use App\Models\Advert;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;

class FrontendController extends Controller
{
    use GeoLocationTrait;
    
    public function index(){
        $categories = Category::orderBy('name','ASC')->take(8)->get();
        $state_id = session('locale')['state_id'];
        $advert_A = Advert::state($state_id)->running()->certifiedShop()->where('position',"A")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_B = Advert::state($state_id)->running()->certifiedShop()->where('position',"B")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_Z = Advert::with('product')->state($state_id)->running()->certifiedProduct()->where('position',"Z")->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        dd($advert_A);
        return view('frontend.index',compact('categories','advert_A','advert_B','advert_Z'));
    }
    
    public function redirect(Advert $advert){
        $advert->clicks =+ 1;
        $advert->save();
        if($advert->advertable_type == 'App\Models\Product'){
            return redirect()->route('product.show',$advert->advertable);
        }else{
            return redirect()->route('vendor.show',$advert->advertable);
        } 
    }

}
