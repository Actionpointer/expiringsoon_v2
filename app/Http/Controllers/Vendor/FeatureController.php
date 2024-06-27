<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Adset;
use App\Models\State;
use App\Models\Adplan;
use App\Models\Feature;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Jobs\MailShopFollowersJob;

class FeatureController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Adset $adset){
        $user = auth()->user();
        $shops = $user->shops->where('status',true)->where('published',true)->where('approved',true);
        $states = State::within()->get();
        $state_id = session('locale')['state_id'];
        $products = Product::within()->live()->isAccessible()->whereHas("shop",function($query) use($shops){ $query->where("user_id",auth()->id());})->get();
        return view('vendor.features.index',compact('adset','products','shops','states','state_id')); 
    }

    public function store(Request $request){
        $products = [];
        $shops = [];
        foreach($request->products as $product_id){
            $products[] = Product::find($product_id);
        }
        $adset = Adset::find($request->adset_id);
        foreach($products as $product){
            if($adset->units > $adset->features->count()){
                $advert = Feature::create(['adset_id'=> $adset->id,'product_id'=> $product->id,'state_id'=> $request->state_id,'approved'=> cache('settings')['auto_approve_product_advert'] ? true:false]);
            }
            $shops[] = $product->shop;
        }
        MailShopFollowersJob::dispatch(array_unique($shops));
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Advert Created'], 200)
        : redirect()->back()->with(['result'=> 1,'message'=>'Ad Created']);
    }

    public function remove(Request $request){
        $adverts = Feature::destroy($request->features);
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Advert Deleted Successfully'], 200)
        : redirect()->back()->with(['result'=> 1,'message'=>'Ad Deleted Successfully']);
    }
    
    public function feature_products(Request $request){
        $products = Product::whereIn('id',$request->products)->live()->isAccessible()->get();
        $allproducts = Product::where('shop_id',$request->shop_id)->live()->isAccessible()->get();
        $states = State::all();
        $state_id = session('locale')['state_id'];
        $adplan = Adplan::where('width',null)->first();
        return view('vendor.features.product',compact('allproducts','products','states','state_id','adplan'));
    }

    public function subscription(Request $request){
        // dd($request->all());
        $shops = [];
        $products = Product::whereIn('id',$request->products)->get();
        $adset = Adset::create(['user_id'=> auth()->id(),'adplan_id' => $request->adplan_id,'units'=> count($request->products),'amount'=> $request->amount,'start_at'=> now(),'end_at'=> now()->addDays($request->days),'auto_renew'=> $request->auto_renew ? true:false]);        
        foreach($products as $product){
            Feature::create(['adset_id'=> $adset->id,'product_id'=> $product->id,'state_id'=> $request->state_id,'approved'=> cache('settings')['auto_approve_product_advert'] ? true:false]);
            $shops[] = $product->shop;
        }
        MailShopFollowersJob::dispatch(array_unique($shops));
        $result = $this->initializePayment($adset->amount,[$adset->id],'App\Models\Adset',$request->coupon_used);
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

    public function filter_products(Request $request){
        $shops = auth()->user()->shops;
        $products = Product::live()->isAccessible()->whereHas("shop",function($query) use($shops){ $query->whereIn("id",$shops->pluck("id")->toArray());});
        if($request->shops)
            $products = $products->whereIn("shop_id",$request->shops);
        $products = $products->with('shop')->get();
        return response()->json(['status' => true,'message' => 'Products filtered ','data' => ProductResource::collection($products)],200);
    }
}
