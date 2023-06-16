<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Plan;
use App\Models\Shop;
use App\Models\Adset;
use App\Models\State;
use App\Models\Adplan;
use App\Models\Advert;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;
use Intervention\Image\Facades\Image;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class AdvertController extends Controller
{
    use GeoLocationTrait,PaymentTrait;

    public function __construct(){
        $this->middleware('auth');
    }

    public function ads(Adset $adset){
        // $adset = auth()->user()->adsets->where('subscribable_id',$adset->id)->first();
        // dd($adset->features->first()->product);
        $user = auth()->user();
        $shops = $user->shops->where('status',true)->where('published',true)->where('approved',true);
        $states = State::within()->get();
        $state_id = session('locale')['state_id'];
        $products = Product::within()->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->whereHas("shop",function($query) use($shops){ $query->where("user_id",auth()->id());})->get();
        if(!$adset->adplan->width || !$adset->adplan->height){
            $categories = Category::whereIn("id",$products->pluck('category_id')->toArray())->get();
            // dd($products->first()->shop->name);
            return view('vendor.adverts.products',compact('adset','products','categories','shops','states','state_id'));
        }else{
            return view('vendor.adverts.shops',compact('adset','shops','states','state_id','products'));
        }
        
    }

    public function store_shop_advert(Request $request){
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'shop_id' => [Rule::requiredIf(!$request->type == 'shop'),'numeric'],
            'product_id' => [Rule::requiredIf(!$request->type == 'product'),'numeric'],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'state_id' => 'required|numeric',
            'heading' => 'required|string',
            'heading' => 'required|string',
            'subheading' => 'required|string',
            'offer' => 'required|string',
            'text_color' => 'required|string',
            'button_text' => 'required|string',
            'button_color' => 'required|string',
        ],[
            'photo.max' => 'The image is too heavy. Standard size is 2mb',
        ]);
        if ($validator->fails()) {
            return request()->expectsJson() ? 
            response()->json(['status' => false,'message'=> $validator->errors()->first()],401):
            redirect()->back()->with(['result'=> 0,'message'=> $validator->errors()->first() ]);
        }
        $adset = Adset::find($request->adset_id);
        if($request->hasFile('photo')){
            $photo = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $path = storage_path('app/public/'.$photo);
            $imgFile = Image::make($request->file('photo'));
            $imgFile->fit(150,150)->save($path);
        } 
        if($adset->units > $adset->adverts->count()){
            $advert = Advert::create(['advertable_id'=> $request->type == 'shop' ? $request->shop_id: $request->product_id,
            'advertable_type'=> $request->type == 'shop' ? 'App\Models\Shop' : 'App\Models\Product',
            'adset_id'=> $adset->id, 'state_id'=> $request->state_id,
            'photo'=> $photo,'heading'=> $request->heading,'subheading'=> $request->subheading,
            'offer'=> $request->offer, 'text_color'=> $request->text_color, 'button_text'=> $request->button_text,
            'button_color'=> $request->button_color,'approved'=> cache('settings')['auto_approve_shop_advert'] ? true:false]);
        } 
        return redirect()->back()->with(['result'=> 1,'message'=>'Ad Created']);
    }

    public function advert_remove(Request $request){
        $adverts = Advert::destroy($request->adverts);
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Advert Deleted Successfully'], 200)
        : redirect()->back()->with(['result'=> 1,'message'=>'Ad Deleted Successfully']);
    }

    public function feature_remove(Request $request){
        $adverts = Feature::destroy($request->features);
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Advert Deleted Successfully'], 200)
        : redirect()->back()->with(['result'=> 1,'message'=>'Ad Deleted Successfully']);
    }
     
    

    public function store_product_advert(Request $request){
        $products = [];
        foreach($request->products as $product_id){
            $products[] = Product::find($product_id);
        }
        $adset = Adset::find($request->adset_id);
        foreach($products as $product){
            if($adset->units > $adset->features->count()){
                $advert = Feature::create(['adset_id'=> $adset->id,'product_id'=> $product->id,'state_id'=> $request->state_id,'approved'=> cache('settings')['auto_approve_product_advert'] ? true:false]);
            }
        }
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Advert Created'], 200)
        : redirect()->back()->with(['result'=> 1,'message'=>'Ad Created']);
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

    public function feature_products(Request $request){
        $products = Product::whereIn('id',$request->products)->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->get();
        $allproducts = Product::where('shop_id',$request->shop_id)->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->get();
        $states = State::all();
        $state_id = session('locale')['state_id'];
        $adplan = Adplan::where('position','Z')->first();
        return view('vendor.adverts.feature',compact('allproducts','products','states','state_id','adplan'));
    }

    public function feature_products_subscription(Request $request){
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