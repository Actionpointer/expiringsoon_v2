<?php

namespace App\Http\Controllers\Guest;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Shop;
use App\Models\State;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
    public function index(){
        $category = null;
        $tag = null;
        $categories = Category::has('products')->get();
        $states = State::has('products')->where('country_id',session('locale')['country_id'])->get();
        $products = Product::withinCountry()->isValid()->isApproved()->isActive()->isAccessible()->isAvailable()->isVisible();
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
            $products = $products->where('tags','like',"%".request()->query('tag')."%");
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
        $advert = Advert::within($state_id)->running()->certifiedShop()->where('position',"F")->orderBy('views','asc')->first();
        if($advert){
            $advert->views = $advert->views + 1;
            $advert->save();
        }
        // dd(array_filter($products->pluck('tags')->flatten()->toArray()));
        return view('frontend.product.list',compact('advert','products','tag','category','categories','states','state_id'));
    }

    public function categories(){
        $categories = Category::all();
        $advert_Z = Advert::with('product')->within()->running()->certifiedProduct()->where('position',"Z")->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        return view('frontend.product.categories',compact('categories','advert_Z'));
    }

    public function show(Product $product){
        // if(!$product->certified){
        //     if(auth()->check() && auth()->id() == $product->shop->user_id){
        //         return view('frontend.product.view',compact('product'));
        //     }
        //     abort(404,'Product is not available');
        // }
        return view('frontend.product.view',compact('product'));
    }

    public function getSubcategories(Request $request){
        // dd($request->all());
        $subcategories = Subcategory::where('category_id',$request->category_id)->get();
        return view('frontend.product.subcategories',compact('subcategories'));
    }

    public function hotdeals(){

        $state_id = session('locale')['state_id'];
        $categories = Category::orderBy('name','ASC')->take(8)->get();
        $advert_C = Advert::within($state_id)->running()->certifiedShop()->where('position',"C")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_D = Advert::within($state_id)->running()->certifiedShop()->where('position',"D")->orderBy('views','asc')->take(2)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_E = Advert::within($state_id)->running()->certifiedShop()->where('position',"E")->orderBy('views','asc')->take(3)->get()->each(function ($item, $key) {$item->increment('views'); });
        $advert_Z = Advert::with('product')->state($state_id)->running()->certifiedProduct()->where('position',"Z")->orderBy('views','asc')->get()->each(function ($item, $key) {$item->increment('views'); });
        // dd($advert_Z);
        
        return view('frontend.hotdeals',compact('categories','advert_C','advert_D','advert_E','advert_Z'));
    }

}
