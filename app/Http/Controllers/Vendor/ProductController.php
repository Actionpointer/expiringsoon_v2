<?php

namespace App\Http\Controllers\Vendor;

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
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show','getSubcategories']);
    }
   
    public function index(Shop $shop){
        $products = Product::where('shop_id',$shop->id)->orderBy('expire_at','desc')->get();
        return view('shop.product.list',compact('shop','products'));
    }

    public function create(Shop $shop){
        $categories = Category::all();
        $tags = Tag::all(); 
        return view('shop.product.create',compact('shop','categories','tags'));
    }

    public function store(Shop $shop,ProductRequest $request){
        $user = auth()->user();
        if($request->hasFile('photo')){
            $photo = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/',$photo);
        } 
        $product = Product::create(['name'=> $request->name,'shop_id'=> $shop->id,'description'=> $request->description,'stock'=> $request->stock,'category_id'=> $request->category_id, 'tags'=> $request->tags,'photo'=> $photo,'expire_at'=> Carbon::parse($request->expiry),'price'=> $request->price,'discount30'=> $request->discount30,'discount60'=> $request->discount60,'discount90'=> $request->discount90,'discount120'=> $request->discount120,
        'published'=> $request->published]);
        return redirect()->route('shop.product.list',$shop);
    }

    public function edit(Shop $shop,Product $product){
        $categories = Category::all();
        $tags = Tag::all(); 
        return view('shop.product.edit',compact('shop','product','categories','tags'));
    }

    public function update(Shop $shop,ProductRequest $request){
        // dd($request->all());
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

    public function manage(Shop $shop,Request $request){
        // dd($request->all());
        $products = Product::whereIn('id',$request->products)->get();
        if($request->published){
            $products = Product::whereIn('id',$request->products)->update(['published'=> true]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'Published Successfully']);
        }
        if($request->draft){
            $products = Product::whereIn('id',$request->products)->update(['published'=> false]);
            return redirect()->back()->with(['result'=> 1,'message'=> 'Drafted Successfully']);
        }
        if($request->delete){
            foreach($products as $product){
                if($product->carts->isEmpty()){
                    $product->delete();
                }
            }    
            return redirect()->back()->with(['result'=> 1,'message'=> 'Deleted Successfully']);
        }
        
    }

}
