<?php

namespace App\Http\Controllers\Guest;

use App\Models\Advert;
use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Resources\AdvertResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\FeaturedResource;

class AdvertController extends Controller
{
    //
    public function ads(){
        $ads = Advert::running()->withinState()->whereHas('adset',function($query){$query->active()->where('adplan_id',1);})->orderBy('views','asc')->take(5)->get()->each(function ($item, $key) {$item->increment('views'); });
        return response()->json([
            'status' => true,
            'message' => 'Adverts retrieved Successfully',
            'count'=> $ads->count(),
            'data' => AdvertResource::collection($ads),
        ], 200);
    }

    public function ad_click(Advert $advert){
        $advert->clicks =+ 1;
        $advert->save();
        if(request()->expectsJson()){
            return response()->json(['status' => true], 200);
        }else{
            if($advert->advertable_type == 'App\Models\Product'){
                return redirect()->route('product.show',$advert->advertable);
            }else{
                return redirect()->route('vendor.show',$advert->advertable);
            } 
        }
        
    }

    public function featured(){
        $features = Feature::with('product')->withinState()->running()->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        return response()->json([
            'status' => true,
            'message' => 'Features retrieved Successfully',
            'data' => FeaturedResource::collection($features),
        ], 200);
    }

    public function featured_click(Feature $feature){
        $feature->clicks =+ 1;
        $feature->save();
        if(request()->expectsJson()){
            return response()->json(['status' => true], 200);
        }else{
            return redirect()->route('product.show',$feature->product);
        }
        
    }
}
