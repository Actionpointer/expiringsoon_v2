<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show','getSubcategories']);
    }
    
    public function index()
    {
        $products = Product::where('status','listed')->orderBy('expiry','desc');
        $categories = Category::all();
        $category = Category::find(1);
        $subcategory = Subcategory::find(1);
        if(request()->query() && request()->query('cat')){
            $products = $products->where('category_id',request()->query('cat'));
            $category = Category::find(request()->query('cat'));
        }
        if(request()->query() && request()->query('cid')){
            $products = $products->where('subcategory_id',request()->query('cid'));
            $subcategory = Subcategory::find(request()->query('cid'));
        }
        $products = $products->get();
        return view('frontend.product.list',compact('products','category','categories','subcategory'));
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
        $products = Product::where('shop_id',$shop->id)->orderBy('expiry','desc')->get();
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

    public function adminIndex()
    {
        $products = Product::where('status','listed')->orderBy('expiry','desc')->get();
        return view('admin.products.list',compact('products'));
    }
}
