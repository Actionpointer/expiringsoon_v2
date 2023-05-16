<?php

namespace App\Http\Controllers\Guest;


use App\Models\State;
use App\Models\Advert;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductDetailsResource;

class ProductController extends Controller
{

    
    public function index(){
        $category = null;
        $tag = null;
        $categories = Category::has('products')->get();
        $states = State::has('products')->where('country_id',session('locale')['country_id'])->get();
        $products = Product::within()->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible();
        if(request()->query() && request()->query('shop_id')){
            $shop_id = request()->query('shop_id');
            $products = $products->where('shop_id',$shop_id);
        }
        if(request()->query() && request()->query('state_id')){
            $state_id = request()->query('state_id');
            $products = $products->whereHas('shop',function($qry) use($state_id){
                $qry->where('state_id',$state_id);
            });
        }else{$state_id = 0;}

        if(request()->query() && request()->query('category_id')){
            $products = $products->where('category_id',request()->query('category_id'));
            $category = Category::find(request()->query('category_id'));
        }
        if(request()->query() && request()->query('tag')){
            $products = $products->where(function($query){ 
                $query->where('tags','like',"%".request()->query('tag')."%")->orWhere('name','like',"%".request()->query('tag')."%")->orWhere('description','like',"%".request()->query('tag')."%");
            });
            $tag = request()->query('tag');
        }
        if(request()->query() && request()->query('sortBy')){
            if(request()->query('sortBy') == 'price_asc'){
                $products = $products->orderBy('price','asc');
            }
            if(request()->query('sortBy') == 'price_desc'){
                $products = $products->orderBy('price','desc');
            }
            if(request()->query('sortBy') == 'expiry_asc'){
                $products = $products->orderBy('expire_at','asc');
            }
            if(request()->query('sortBy') == 'expiry_desc'){
                $products = $products->orderBy('expire_at','desc');
            }
        }
        $products = $products->paginate(16);
        if(request()->expectsJson()){
            return response()->json([
                'status' => true,
                'message' => 'Products Retrieved',
                'data' => ProductResource::collection($products),
                'meta'=> [
                    "total"=> $products->total(),
                    "per_page"=> $products->perPage(),
                    "current_page"=> $products->currentPage(),
                    "last_page"=> $products->lastPage(),
                    "first_page_url"=> $products->url(1),
                    "last_page_url"=> $products->url($products->lastPage()),
                    "next_page_url"=> $products->nextPageUrl(),
                    "prev_page_url"=> $products->previousPageUrl(),
                ]
                
            ], 200);
        }else{
            // $advert = Advert::withinState($state_id)->running()->certifiedShop()->where('position',"F")->orderBy('views','asc')->first();
            $advert = null;
            if($advert){
                $advert->views = $advert->views + 1;
                $advert->save();
            }
            // dd(array_filter($products->pluck('tags')->flatten()->toArray()));
            return view('frontend.product.list',compact('advert','products','tag','category','categories','states','state_id'));
        }
    }

    public function categories(){
        $categories = Category::all();
        $advert_Z = Advert::with('product')->within()->running()->certifiedProduct()->where('position',"Z")->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        return view('frontend.product.categories',compact('categories','advert_Z'));
    }

    public function show(Product $product){
        if(!$product->certified()){
            return request()->expectsJson() ?
            response()->json([
                'status' => false,
                'message' => 'Product is no longer available',
                'data' => [],
            ], 400) :
            redirect()->back()->with(['result'=> 0,'message'=> 'Product is no longer available']);
        }
        $similar = Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->whereHas('adverts',function($query){
            $query->running()->certifiedProduct();
        })->get();
        if($similar->isEmpty()){
            $similar = Product::where('category_id',$product->category_id)->where('id','!=',$product->id)->get();
        }
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => 'Product details retrieved Successfully',
                'data' => new ProductDetailsResource($product),
            ], 200) :
            view('frontend.product.view',compact('product','similar'));

    }

    public function getSubcategories(Request $request){
        // dd($request->all());
        $subcategories = Subcategory::where('category_id',$request->category_id)->get();
        return view('frontend.product.subcategories',compact('subcategories'));
    }

    public function hotdeals(){

        $state_id = session('locale')['state_id'];
        $categories = Category::orderBy('name','ASC')->take(8)->get();
        // $advert_C = Advert::withinState($state_id)->running()->certifiedShop()->where('position',"C")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        // $advert_D = Advert::withinState($state_id)->running()->certifiedShop()->where('position',"D")->orderBy('views','asc')->take(2)->get()->each(function ($item, $key) {$item->increment('views'); });
        // $advert_E = Advert::withinState($state_id)->running()->certifiedShop()->where('position',"E")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_C = [];
        $advert_D = [];
        $advert_E = [];
        $advert_Z = Advert::with('product')->within($state_id)->running()->certifiedProduct()->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        $products = Product::whereIn('id',$advert_Z->pluck('product_id'))->paginate(10);
        if(request()->expectsJson()){
            return response()->json([
                'status' => true,
                'message' => $products->count() ? 'Hotdeals Retrieved' : 'No hotdeals retrieved',
                'data' => ProductResource::collection($products),
                'meta'=> [
                    "total"=> $products->total(),
                    "per_page"=> $products->perPage(),
                    "current_page"=> $products->currentPage(),
                    "last_page"=> $products->lastPage(),
                    "first_page_url"=> $products->url(1),
                    "last_page_url"=> $products->url($products->lastPage()),
                    "next_page_url"=> $products->nextPageUrl(),
                    "prev_page_url"=> $products->previousPageUrl(),
                ]
                
            ], 200);
        }else
        return view('frontend.hotdeals',compact('categories','advert_C','advert_D','advert_E','advert_Z'));
    }

    

    

}
