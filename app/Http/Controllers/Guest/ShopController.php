<?php

namespace App\Http\Controllers\Guest;

use App\Models\Shop;
use App\Models\State;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use App\Http\Resources\ShopDetailsResource;

class ShopController extends Controller
{
    
    public function index(){
        $category = null;
        $categories = Category::has('products')->get();
        $states = State::has('products')->get();
        $name = null;
        $shops = Shop::isActive()->isApproved()->isVisible()->isSelling();
        if(request()->query() && request()->query('state_id')){
            $state_id = request()->query('state_id');
            $shops = $shops->where('state_id',$state_id);
        }else{$state_id = 0;}
        if(request()->query() && request()->query('category_id')){
            $category_id = request()->query('category_id');
            $category = Category::find($category_id);
            $shops = $shops->whereHas('products',function($query) use($category_id){
                $query->where('category_id',$category_id);
            });
        }
        if(request()->query() && request()->query('name')){
            $name = request()->query('name');
            $shops = $shops->where('name','LIKE',"%$name%");
        }
        if(request()->query() && request()->query('sortBy')){
            if(request()->query('sortBy') == 'name_asc'){
                $shops = $shops->orderBy('name','asc');
            }
            if(request()->query('sortBy') == 'name_desc'){
                $shops = $shops->orderBy('name','desc');
            }
        }
        $shops = $shops->paginate(16);
        if(request()->expectsJson()){
            return response()->json([
                'status' => true,
                'message' => 'Vendors Retrieved',
                'data' => ShopResource::collection($shops),
                'meta'=> [
                    "total"=> $shops->total(),
                    "per_page"=> $shops->perPage(),
                    "current_page"=> $shops->currentPage(),
                    "last_page"=> $shops->lastPage(),
                    "first_page_url"=> $shops->url(1),
                    "last_page_url"=> $shops->url($shops->lastPage()),
                    "next_page_url"=> $shops->nextPageUrl(),
                    "prev_page_url"=> $shops->previousPageUrl(),
                ]
                
            ], 200);
        }else{
            // $advert_G = Advert::withinState($state_id)->running()->certifiedShop()->where('position',"G")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
            // $advert_H = Advert::withinState($state_id)->running()->certifiedShop()->where('position',"H")->orderBy('views','asc')->take(2)->get()->each(function ($item, $key) {$item->increment('views'); });
            $advert_G = [];
            $advert_H = [];
            return view('frontend.shop.list',compact('shops','category','categories','name','states','state_id','advert_G','advert_H'));
        }
        
        
    }

    public function show(Shop $shop){
        if(!$shop->certified()){
            return request()->expectsJson() ?
            response()->json([
                'status' => false,
                'message' => 'Shop is not available',
            ],400): 
            redirect()->back()->with(['result'=> 0,'message'=> 'Shop is not available']);
        }
        if(request()->expectsJson()){
            return  response()->json([
                'status' => true,
                'message' => 'Product details retrieved Successfully',
                'data' =>  new ShopDetailsResource($shop),
                ], 200);
        }
        $category = null;
        $categories = Category::has('products')->get();
        $products = Product::where('shop_id',$shop->id)->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible();
        if(request()->query() && request()->query('category_id')){
            $products = $products->where('category_id',request()->query('category_id'));
            $category = Category::find(request()->query('category_id'));
        }
        if(request()->query() && request()->query('sortBy')){
            if(request()->query('sortBy') == 'price_asc'){
                $products = $products->orderBy('price','asc');
            }
            if(request()->query('sortBy') == 'price_desc'){
                $products = $products->orderBy('price','desc');
            }
        }
        $products = $products->paginate(16);
        return view('frontend.shop.view',compact('shop','categories','products','category'));

    }

    
}
