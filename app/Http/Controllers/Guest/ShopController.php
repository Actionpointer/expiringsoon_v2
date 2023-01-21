<?php

namespace App\Http\Controllers\Guest;

use App\Models\Shop;
use App\Models\State;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    
    public function index(){
        $category = null;
        $categories = Category::has('products')->get();
        $states = State::has('products')->get();
        
        $shops = Shop::native()->active()->approved()->visible()->selling();
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
        if(request()->query() && request()->query('sortBy')){
            if(request()->query('sortBy') == 'name_asc'){
                $shops = $shops->orderBy('name','asc');
            }
            if(request()->query('sortBy') == 'name_desc'){
                $shops = $shops->orderBy('name','desc');
            }
        }
        $shops = $shops->paginate(16);
        $advert_G = Advert::state($state_id)->running()->certifiedShop()->where('position',"G")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_H = Advert::state($state_id)->running()->certifiedShop()->where('position',"H")->orderBy('views','asc')->take(2)->get()->each(function ($item, $key) {$item->increment('views'); });
        return view('frontend.shop.list',compact('shops','category','categories','states','state_id','advert_G','advert_H'));
    }

    public function show(Shop $shop){
        if(!$shop->isCertified())
        abort(404,'Shop is not available');
        $category = null;
        $categories = Category::has('products')->get();
        $products = Product::where('shop_id',$shop->id)->edible()->approved()->active()->accessible()->available()->visible();
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
        $products = $products->paginate(2);
        return view('frontend.shop.view',compact('shop','categories','products','category'));
    }
}
