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
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\ProductDetailsResource;

class ProductController extends Controller
{

    
    public function index(){
        $category = null;
        $tag = null;
        $categories = Category::has('products')->get();
        $states = State::has('products')->where('country_id',session('locale')['country_id'])->get();
        $products = Product::withCount('features')->within()->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->orderBy('features_count','desc');
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
        $products_paginated = $products->paginate(16);
        $products = $products_paginated->sortBy(function($item) {
            return $item->discount;
        });
    
        $products = new LengthAwarePaginator($products, $products_paginated->total(), $products_paginated->perPage());
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
            return view('frontend.product.list',compact('products','tag','category','categories','states','state_id'));
        }
    }

    public function categories(){
        $categories = Category::all();
        return view('frontend.product.categories',compact('categories'));
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
        $similar = Product::withCount('features')->within()->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->where('category_id',$product->category_id)->where('id','!=',$product->id)->orderBy('features_count','desc')->get();
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

        $categories = Category::orderBy('name','ASC')->take(8)->get();
        $products = Product::withCount('features')->within()->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible()->orderBy('features_count','desc');
        if(request()->expectsJson()){
            $products = $products->paginate(16);
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
        }else{
            $products = $products->get();
            $ranges = [[0,19],[20,30],[30,40],[40,50],[50,100]];
            $counter = [];
            foreach($ranges as $range){
                $counter[] = $products->whereBetween('discount',$range)->count();
            }
            $highest = array_search(max($counter),$counter);
            return view('frontend.hotdeals',compact('categories','products','ranges','highest'));
        }
        
    }

    

    

}
