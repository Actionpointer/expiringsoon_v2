<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Plan;
use App\Models\Shop;
use App\Models\State;
use App\Models\Adplan;
use App\Models\Advert;
use App\Models\Feature;
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

    
    

    public function ads(Feature $feature){
        // $feature = auth()->user()->features->where('subscribable_id',$feature->id)->first();
        $user = auth()->user();
        $shops = $user->shops->where('status',true)->where('published',true)->where('approved',true);
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
                $advert = Advert::create(['feature_id'=> $feature->id,'position'=> $feature->adplan->position,'advertable_id'=> $product->id,'advertable_type'=> get_class($product),'state_id'=> $request->state_id,'approved'=> cache('settings')['auto_approve_product_advert'] ? true:false]);
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
                $advert = Advert::create(['feature_id'=> $feature->id,'position'=> $feature->adplan->position,'advertable_id'=> $shop->id,'advertable_type'=> get_class($shop),'state_id'=> $request->state_id,'approved'=> cache('settings')['auto_approve_shop_advert'] ? true:false]);
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

    public function feature_products(Request $request){
        $products = Product::whereIn('id',$request->products)->edible()->approved()->active()->accessible()->available()->visible()->get();
        $allproducts = Product::where('shop_id',$request->shop_id)->edible()->approved()->active()->accessible()->available()->visible()->get();
        $states = State::all();
        $state_id = $this->currentState()->id;
        $adplan = Adplan::where('position','Z')->first();
        return view('vendor.features.ads',compact('allproducts','products','states','state_id','adplan'));
    }

    public function feature_products_subscription(Request $request){
        // dd($request->all());
        $products = Product::whereIn('id',$request->products)->get();
        $feature = Feature::create(['user_id'=> auth()->id(),'adplan_id' => $request->adplan_id,'units'=> count($request->products),'amount'=> $request->amount,'start_at'=> now(),'end_at'=> now()->addDays($request->days),'auto_renew'=> $request->auto_renew ? true:false]);        
        foreach($products as $product){
            $advert = Advert::create(['feature_id'=> $feature->id,'position'=> $feature->adplan->position,'advertable_id'=> $product->id,'advertable_type'=> get_class($product),'state_id'=> $request->state_id]);
        }
        $link = $this->initializePayment($feature->amount,[$feature->id],'App\Models\Feature');
        if(!$link)
            return 'PAGE SHOWING service unavailable right now.. ask the user to TRY AGAIN LATER';
        else
        return redirect()->to($link);
    }

}