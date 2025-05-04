<?php

namespace App\Http\Controllers\Guest;

use App\Models\Shop;
use App\Models\State;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Http\Resources\StoreDetailsResource;

class StoreController extends Controller
{
    
    public function index(){
        $name = null;
        $category = null;
        $categories = Category::all();
        $states = State::has('products')->get();
        $shops = Shop::live()->selling();
        if(request()->query() && request()->query('state_id')){
            $state_id = request()->query('state_id');
            $shops = $shops->where('state_id',$state_id);
        }else{$state_id = 0;}
        if(request()->query() && request()->query('category_id')){
            $category_id = request()->query('category_id');
            $category = Category::find($category_id);
            $subcategories = $category->subcategories->pluck('name');
            $shops = $shops->whereHas('products',function($query) use($subcategories){
                        $query->where(function($qry) use($subcategories) { 
                            foreach($subcategories as $tag){ 
                                $qry->orWhereJsonContains("tags",$tag); 
                            }
                        }); 
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
                'data' => StoreResource::collection($shops),
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
            // $advert_G = Advert::withinState($state_id)->running()->live()->where('position',"G")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
            // $advert_H = Advert::withinState($state_id)->running()->live()->where('position',"H")->orderBy('views','asc')->take(2)->get()->each(function ($item, $key) {$item->increment('views'); });
            $advert_G = [];
            $advert_H = [];
            return view('frontend.shop.list',compact('shops','category','categories','name','states','state_id','advert_G','advert_H'));
        }
        
        
    }

    public function show(Shop $shop){
        if($shop->status != 'live'){
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
                'data' =>  new StoreDetailsResource($shop),
                ], 200);
        }
        $category = null;
        $categories = Category::all();
        $products = Product::where('shop_id',$shop->id)->live()->isAccessible();
        if(request()->query() && request()->query('category_id')){
            $category_id = request()->query('category_id');
            $category = Category::find($category_id);
            $subcategories = $category->subcategories->pluck('name');
            $products = $products->where(function($qry) use($subcategories) { 
                            foreach($subcategories as $tag){ 
                                $qry->orWhereJsonContains("tags",$tag); 
                            }
                        }); 

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
