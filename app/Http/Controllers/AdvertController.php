<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Shop;
use App\Models\State;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('redirect');
    }
    
    public function index(){
        $plans = Plan::where('type','advert')->get();
        return view('vendor.features.index',compact('plans'));
    }
    
    public function description(Plan $plan){
        return view('vendor.features.description',compact('plan'));
    }

    public function create(Plan $plan){
        $subscription = auth()->user()->advertSubscriptions->where('plan_id',$plan->id)->first();
        $shops = auth()->user()->shops;
        $states = State::all();
        if($plan->products){
            $products = Product::edible()->approved()->accessible()->available()->visible()->whereHas("shop",function($query) use($shops){ $query->whereIn("id",$shops->pluck("id")->toArray());})->get();
            $categories = Category::whereIn("id",$products->pluck('category_id')->toArray())->get();
            return view('vendor.features.products',compact('subscription','products','categories','shops','states'));
        }else
        return view('vendor.features.shops',compact('subscription','shops','states'));
    }

    public function store_product_advert(Request $request){
        $shops = auth()->user()->shops;
        if($request->allproducts)
           $products = Product::whereHas("shop",function($query) use($shops){ $query->whereIn("id",$shops->pluck("id")->toArray());})->get();
        else 
            $products = [];
        foreach($request->products as $product_id){
            $products[] = Product::find($product_id);
        }
        foreach($products as $product){
            $advert =  new Advert;
            $advert->subscription_id =  $request->subscription_id;
            $advert->advertable_id =  $product->id;
            $advert->advertable_type = get_class($product);
            $advert->state_id = $request->state_id;
            $advert->save();
        }
        return redirect()->back();
    }

    public function store_shop_advert(Request $request){
        if($request->allshops)
           $shops = auth()->user()->shops;
        else 
           $shops = [];
        foreach($request->shops as $shop_id){
            $shops[ ] = Shop::find($shop_id);
        }
        foreach($shops as $shop){
            $advert =  new Advert;
            $advert->subscription_id =  $request->subscription_id;
            $advert->advertable_id =  $shop->id;
            $advert->advertable_type = get_class($shop);
            $advert->state_id = $request->state_id;
            $advert->save();   
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

    public function redirect(Advert $advert){
        $advert->clicks =+ 1;
        $advert->save();
        if($advert->advertable_type == 'App\Models\Product'){
            return redirect()->route('product.show',$advert->advertable);
        }else{
            return redirect()->route('vendor.show',$advert->advertable);
        } 
    }

    public function admin_index(){
        $adverts = Advert::all();
        return view('admin.adverts',compact('adverts'));
    }

    public function manage_advert(Request $request){
        if($request->action == "delete")
            $advert = Advert::where("id",$request->advert_id)->delete();
        else 
            $advert = Advert::where("id",$request->advert_id)->update(["status"=> $request->status]);
    }

    public function manage(Request $request){
        if($request->action == 'publish'){
            $adverts = Advert::whereIn('id',$request->adverts)->update(['status'=> 1]);
        }else{
            $adverts = Advert::whereIn('id',$request->adverts)->update(['status'=> 0]);
        }
        return redirect()->back();
    }

    public function admin_manage(Request $request){
        $advert = Advert::find($request->advert_id);
        $advert->status = $request->action == 'disapprove'?false:true;
        $advert->save();
        return redirect()->back();
    }

}