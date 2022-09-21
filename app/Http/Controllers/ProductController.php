<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Shop;
use App\Models\State;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show','getSubcategories']);
    }
    
    public function index(){
        // product is visible, product is in locale, 
        $category = null;
        $categories = Category::has('products')->get();
        $states = State::has('products')->get();
        $products = Product::edible()->approved()->active()->accessible()->available()->visible();
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
        $advert = Advert::state($state_id)->running()->certifiedShop()->where('position',"F")->orderBy('views','asc')->first();
        if($advert){
            $advert->views = $advert->views + 1;
            $advert->save();
        }
        return view('frontend.product.list',compact('advert','products','category','categories','states','state_id'));
    }

    public function show(Product $product){
        // if(!$product->isCertified()){
        //     if(auth()->check() && auth()->id() == $product->shop->owner()->id){
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

    /* Vendor area */    
    public function list(Shop $shop){
        $products = Product::where('shop_id',$shop->id)->orderBy('expire_at','desc')->get();
        return view('shop.product.list',compact('shop','products'));
    }

    public function create(Shop $shop){
        $categories = Category::all();
        $tags = Tag::all(); 
        return view('shop.product.create',compact('shop','categories','tags'));
    }

    public function store(Shop $shop,ProductRequest $request){
        if($request->hasFile('photo')){
            $photo = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$photo);
        } 
        $product = Product::create(['name'=> $request->name,'shop_id'=> $shop->id,'description'=> $request->description,'stock'=> $request->stock,'category_id'=> $request->category_id, 'tags'=> $request->tags,'photo'=> $photo,'expire_at'=> Carbon::parse($request->expiry),'price'=> $request->price,'discount30'=> $request->discount30,'discount60'=> $request->discount60,'discount90'=> $request->discount90,'discount120'=> $request->discount120,'published'=> $request->published]);
        return redirect()->route('shop.product.list',$shop);
    }

    public function edit(Shop $shop,Product $product){
        $categories = Category::all();
        $tags = Tag::all(); 
        return view('shop.product.edit',compact('shop','product','categories','tags'));
    }

    public function update(Shop $shop,Request $request){
        $product = Product::find($request->product_id);
        if($request->hasFile('photo')){
            if($product->photo) Storage::delete('public/'.$product->photo);
            $photo = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$photo);
            $product->update(['photo'=> $photo]);
        } 
        $product->update(['name'=> $request->name,'shop_id'=> $shop->id,'description'=> $request->description,'stock'=> $request->stock,'category_id'=> $request->category_id, 'tags'=> $request->tags,'expire_at'=> Carbon::parse($request->expiry),'price'=> $request->price,'discount30'=> $request->discount30,'discount60'=> $request->discount60,'discount90'=> $request->discount90,'discount120'=> $request->discount120,'published'=> $request->published]);
        return redirect()->route('shop.product.list',$shop);
    }

    public function destroy(Shop $shop,Request $request){
        $products = Product::whereIn('id',$request->products)->get();
        foreach($products as $product){
            if($product->carts->isEmpty()){
                $product->delete();
            }
        }
        return redirect()->back();
    }


    public function admin_index()
    {
        $products = Product::where('published',true)->orderBy('expire_at','desc')->get();
        return view('admin.products',compact('products'));
    }

    public function admin_manage(Request $request){
        if($request->delete){
            $products = Product::whereIn('id',$request->products)->whereDoesntHave('orders')->get();
            $products->each->delete();
            return redirect()->back()->with(['result'=>1,'message'=> 'Products deleted Successfully']);
        }else{
            $products = Product::whereIn('id',$request->products)->update(['status'=> $request->approved]);
        }
        return redirect()->back()->with(['result'=>1,'message'=> 'Products updated Successfully']);
    }
}
