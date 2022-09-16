<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\State;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show','getSubcategories']);
    }
    
    public function index()
    {
        // product is visible, product is in locale, 
        $category = null;
        $categories = Category::has('products')->get();
        $states = State::has('products')->get();
        $products = Product::edible()->approved()->accessible()->available()->visible();
        if(request()->query() && request()->query('state_id')){
            if(request()->query('state_id') != '-1'){
                $state_id = request()->query('state_id');
                $products = $products->whereHas('shop',function($qry) use($state_id){
                    $qry->where('state_id',$state_id);
                });
            }
        }else{$state_id = 0;}
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
            if(request()->query('sortBy') == 'expiry_asc'){
                $products = $products->orderBy('expire_at','asc');
            }
            if(request()->query('sortBy') == 'expiry_desc'){
                $products = $products->orderBy('expire_at','desc');
            }
        }
        $products = $products->paginate(16);
        $advert = Advert::state($state_id)->running()->where('position',"F")->orderBy('views','asc')->first();
        if($advert){
            $advert->views = $advert->views + 1;
            $advert->save();
        }
        return view('frontend.product.list',compact('advert','products','category','categories','states','state_id'));
    }

    public function show(Product $product)
    {
        return view('frontend.product.view',compact('product'));
    }

    public function getSubcategories(Request $request){
        // dd($request->all());
        $subcategories = Subcategory::where('category_id',$request->category_id)->get();
        return view('frontend.product.subcategories',compact('subcategories'));
    }

    /* Vendor area */    
    public function list(Shop $shop){
        $products = Product::where('shop_id',$shop->id)->orderBy('expire_at','desc')->get();
        return view('shop.product.list',compact('shop','products'));
    }

    public function create(Shop $shop){
        $categories = Category::all();
        return view('shop.product.create',compact('shop','categories'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function admin_index()
    {
        $products = Product::where('visible',true)->orderBy('expire_at','desc')->get();
        return view('admin.products',compact('products'));
    }

    public function admin_manage(Request $request){
        if($request->action == 'approve'){
            $products = Product::whereIn('id',$request->products)->update(['status'=> 1]);
        }else{
            $products = Product::whereIn('id',$request->products)->update(['status'=> '-1']);
        }
        return redirect()->back();
    }
}
