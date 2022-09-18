<?php

namespace App\Http\Controllers;

use App\Http\Traits\GeoLocationTrait;
use App\Models\Plan;
use App\Models\Shop;
use App\Models\State;
use App\Models\Advert;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    use GeoLocationTrait;

    public function __construct(){
        $this->middleware('auth')->except('redirect');
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

    public function create(Feature $feature){
        // $feature = auth()->user()->features->where('subscribable_id',$feature->id)->first();
        $shops = Shop::where('user_id',auth()->id())->active()->visible()->approved()->selling()->get();
        $states = State::all();
        $state_id = $this->currentState()->id;
        if($feature->adplan->type == 'products'){
            $products = Product::edible()->approved()->active()->accessible()->available()->visible()->whereHas("shop",function($query) use($shops){ $query->whereIn("id",$shops->pluck("id")->toArray());})->get();
            $categories = Category::whereIn("id",$products->pluck('category_id')->toArray())->get();
            return view('vendor.features.products',compact('feature','products','categories','shops','states','state_id'));
        }else
        return view('vendor.features.shops',compact('feature','shops','states','state_id'));
    }

    public function store_product_advert(Request $request){
        $products = [];
        foreach($request->products as $product_id){
            $products[] = Product::find($product_id);
        }
        $feature = Feature::find($request->feature_id);
        foreach($products as $product){
            if($feature->units > $feature->adverts->count()){
                $advert =  new Advert;
                $advert->feature_id =  $request->feature_id;
                $advert->position =  $feature->adplan->position;
                $advert->advertable_id =  $product->id;
                $advert->advertable_type = get_class($product);
                $advert->state_id = $request->state_id;
                $advert->save();
            }
        }
        return redirect()->back();
    }

    public function store_shop_advert(Request $request){
        $shops = [];
        foreach($request->shops as $shop_id){
            $shops[] = Shop::find($shop_id);
        }
        $feature = Feature::find($request->feature_id);
        foreach($shops as $shop){
            if($feature->units > $feature->adverts->count()){
                $advert =  new Advert;
                $advert->feature_id =  $request->feature_id;
                $advert->position =  $feature->adplan->position;
                $advert->advertable_id =  $shop->id;
                $advert->advertable_type = get_class($shop);
                $advert->state_id = $request->state_id;
                $advert->save();  
            }  
        }
        return redirect()->back();
    }
     
    public function filter_products(Request $request){
        $shops = auth()->user()->shops;
        $products = Product::whereHas("shop",function($query) use($shops){ $query->whereIn("id",$shops->pluck("id")->toArray());});
        if($request->shops)
            $products = $products->whereIn("shop_id",$request->shops);
        if($request->categories)
            $products = $products->whereIn('category_id', $request->categories);
        $products = $products->with('shop')->get();
        return response()->json($products,200);
    }

    public function remove(Request $request){
        $adverts = Advert::destroy($request->adverts);
        return redirect()->back()->with(['result'=> 1,'message'=> 'Ads Deleted Successfully']);
    }

    public function admin_index(){
        $adverts = Advert::all();
        return view('admin.adverts',compact('adverts'));
    }

    public function admin_manage(Request $request){
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

}