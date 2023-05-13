<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Plan;
use App\Models\Shop;
use App\Models\State;
use App\Models\Adplan;
use App\Models\Advert;
use App\Models\Adset;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;
use App\Http\Resources\ProductResource;

class AdvertController extends Controller
{
    use GeoLocationTrait,PaymentTrait;

    public function __construct(){
        $this->middleware('auth');
    }

    public function ads(Adset $adset){
        // $adset = auth()->user()->adsets->where('subscribable_id',$adset->id)->first();
        $user = auth()->user();
        $shops = $user->shops->where('status',true)->where('published',true)->where('approved',true);
        $states = State::within()->get();
        $state_id = session('locale')['state_id'];
        if($adset->adplan->type == 'products'){
            $products = Product::within()->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->whereHas("shop",function($query) use($shops){ $query->whereIn("id",$shops->pluck("id")->toArray());})->get();
            $categories = Category::whereIn("id",$products->pluck('category_id')->toArray())->get();
            // dd($products->first()->shop->name);
            return view('vendor.adverts.products',compact('adset','products','categories','shops','states','state_id'));
        }else
        return view('vendor.adverts.shops',compact('adset','shops','states','state_id'));
    }

    public function store_product_advert(Request $request){
        $products = [];
        foreach($request->products as $product_id){
            $products[] = Product::find($product_id);
        }
        $adset = Adset::find($request->adset_id);
        foreach($products as $product){
            if($adset->units > $adset->adverts->count()){
                $advert = Advert::create(['adset_id'=> $adset->id,'position'=> $adset->adplan->position,'advertable_id'=> $product->id,'advertable_type'=> get_class($product),'state_id'=> $request->state_id,'approved'=> cache('settings')['auto_approve_product_advert'] ? true:false]);
            }
        }
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Advert Created'], 200)
        : redirect()->back()->with(['result'=> 1,'message'=>'Ad Created']);
    }

    public function store_shop_advert(Request $request){
        $shop = Shop::find($request->shop_id);
        $adset = Adset::find($request->adset_id);
        if($request->hasFile('photo')){
            $photo = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$photo);
        } 
        if($adset->units > $adset->adverts->count()){
            $advert = Advert::create(['adset_id'=> $adset->id,'position'=> $adset->adplan->position,'advertable_id'=> $shop->id,'advertable_type'=> get_class($shop),
            'state_id'=> $request->state_id,'photo'=> $photo,'heading'=> $request->heading,
            'subheading'=> $request->subheading,'offer'=> $request->offer,
            'approved'=> cache('settings')['auto_approve_shop_advert'] ? true:false]);
        } 
        return redirect()->back()->with(['result'=> 1,'message'=>'Ad Created']);
    }
     
    public function filter_products(Request $request){
        $shops = auth()->user()->shops;
        $products = Product::whereHas("shop",function($query) use($shops){ $query->whereIn("id",$shops->pluck("id")->toArray());});
        if($request->shops)
            $products = $products->whereIn("shop_id",$request->shops);
        if($request->categories)
            $products = $products->whereIn('category_id', $request->categories);
        $products = $products->with('shop')->get();
        return response()->json(['status' => true,'message' => 'Products filtered ','data' => ProductResource::collection($products)],200);
    }
    

    public function remove(Request $request){
        $adverts = Advert::destroy($request->adverts);
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Advert Deleted Successfully'], 200)
        : redirect()->back()->with(['result'=> 1,'message'=>'Ad Deleted Successfully']);
    }

    public function adset_products(Request $request){
        $products = Product::whereIn('id',$request->products)->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->get();
        $allproducts = Product::where('shop_id',$request->shop_id)->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->get();
        $states = State::all();
        $state_id = session('locale')['state_id'];
        $adplan = Adplan::where('position','Z')->first();
        return view('vendor.adverts.ads',compact('allproducts','products','states','state_id','adplan'));
    }

    public function adset_products_subscription(Request $request){
        // dd($request->all());
        $products = Product::whereIn('id',$request->products)->get();
        $adset = Adset::create(['user_id'=> auth()->id(),'adplan_id' => $request->adplan_id,'units'=> count($request->products),'amount'=> $request->amount,'start_at'=> now(),'end_at'=> now()->addDays($request->days),'auto_renew'=> $request->auto_renew ? true:false]);        
        foreach($products as $product){
            $advert = Advert::create(['adset_id'=> $adset->id,'position'=> $adset->adplan->position,'advertable_id'=> $product->id,'advertable_type'=> get_class($product),'state_id'=> $request->state_id]);
        }
        $result = $this->initializePayment($adset->amount,[$adset->id],'App\Models\Adset');
        if(!$result['link']){
            return request()->expectsJson() ? 
                response()->json([
                    'status' => false,
                    'message' => 'Something went wrong',
                ], 401) :
                redirect()->back()->with(['result'=> 0,'message'=> 'Something went wrong, Please try again later']);
        }else{
            return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Open payment link on browser to complete payment',
                'data' => $result,
            ], 200) :
            redirect()->to($result['link']);
        }    
        
    }

}