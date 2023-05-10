<?php

namespace App\Http\Controllers\Vendor;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Cart;
use App\Models\Like;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductDetailsResource;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth:sanctum');
    }
   
    public function index(Shop $shop){
        $products = Product::where('shop_id',$shop->id)->orderBy('expire_at','desc')->get();
        return request()->expectsJson() ?
            response()->json([
                'status' => true,
                'message' => $products->count() ? 'Products retrieved Successfully':'No Products retrieved',
                'data' => ProductResource::collection($products),
                'count' => $products->count()
            ], 200) :
            view('vendor.shop.product.list',compact('shop','products'));
    }

    public function create(Shop $shop){
        $categories = Category::all();
        $tags = Tag::all(); 
        return view('vendor.shop.product.create',compact('shop','categories','tags'));
    }

    public function details(Shop $shop,Product $product){
        if($product && $shop && $product->shop_id == $shop->id){
            return response()->json([
                'status' => true,
                'message' => 'Products retrieved Successfully',
                'data' => new ProductDetailsResource($product)
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Product does not exist',
                'data' => null,
                'count' => 0
            ], 401);
        }
    }

    public function store(Shop $shop,Request $request){
        // dd($request->all());2023-02-04
        try {
            $date_limit = now()->addHours(cache('settings')['order_processing_to_delivery_period']);
            $date_beyond = Carbon::parse('2038-01-01');
            $validator = Validator::make($request->all(), 
            [
                'shop_id' => 'required|numeric',
                'name' => 'required|max:255',
                'description' => 'required',
                'stock' => 'required|numeric|gt:1',
                'category_id' => 'required|numeric',
                'tags' => 'nullable',
                'photo' => 'required|max:5120|image',
                'expiry' => ['required','date',"after:$date_limit","before:$date_beyond"],
                'price' => 'required|numeric',
                'discount120' => 'nullable|lt:price|gt:discount90',
                'discount90' => 'nullable|lt:price|gt:discount60',
                'discount60' => 'nullable|lt:price|gt:discount30',
                'discount30' => 'nullable|lt:price',    
                'published' => 'required|numeric',   
            ],[
                'photo.max' => 'The image is too heavy. Standard size is 5mb',
                'discount120.gt' => 'Discount price for 120 days must be higher than that for 90 days',
                'discount90.gt' => 'Discount price for 90 days must be higher than that for 60 days',
                'discount60.gt' => 'Discount price for 60 days must be higher than that for 30 days',
                'lt' => 'This discount price must be less than actual price',
            ]);
            if($validator->fails()){
                return request()->expectsJson() ?
                 response()->json([
                    'status' => false,
                    'message'=> $validator->errors()->first()
                ], 401) :
                redirect()->back()->withErrors($validator)->withInput()->with(['result'=> '0','message'=> $validator->errors()->first()]);
            }
            /** @var \App\Models\User $user **/
            $user = auth()->user();
            $shop = Shop::where('id',$request->shop_id)->where('user_id',$user->id)->first();
            if($request->hasFile('photo')){
                $photo = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->storeAs('public/',$photo);
            } 
            $product = Product::create(['name'=> $request->name,'shop_id'=> $shop->id,
            'description'=> $request->description,'stock'=> $request->stock,'category_id'=> $request->category_id,
            'tags'=> $request->tags,'photo'=> $photo,'expire_at'=> Carbon::parse($request->expiry),
            'price'=> $request->price,'discount30'=> $request->discount30,'discount60'=> $request->discount60,
            'discount90'=> $request->discount90,'discount120'=> $request->discount120,
            'published'=> $request->published]);
            return request()->expectsJson()
                ? response()->json(['status' => true, 'message' => 'Product Created Successfully'], 200) :
                    redirect()->route('vendor.shop.product.list',$shop);
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    
    }

    public function edit(Shop $shop,Product $product){
        $categories = Category::all();
        $tags = Tag::all(); 
        return view('vendor.shop.product.edit',compact('shop','product','categories','tags'));
    }

    public function update(Shop $shop,Request $request){
        // dd($request->all());
        
        try {
            $date_limit = now()->addHours(cache('settings')['order_processing_to_delivery_period']);
            $date_beyond = Carbon::parse('2038-01-01');
            $validator = Validator::make($request->all(), 
            [
                'product_id' => 'required|numeric',
                'shop_id' => 'required|numeric',
                'name' => 'required|max:255',
                'description' => 'required',
                'stock' => 'required|numeric|gt:1',
                'category_id' => 'required|numeric',
                'tags' => 'nullable',
                'photo' => 'nullable|max:5120|image',
                'expiry' => ['required','date',"after:$date_limit","before:$date_beyond"],
                'price' => 'required|numeric',
                'discount120' => 'nullable|lt:price|gt:discount90',
                'discount90' => 'nullable|lt:price|gt:discount60',
                'discount60' => 'nullable|lt:price|gt:discount30',
                'discount30' => 'nullable|lt:price',   
                'published' => 'required|numeric',  
            ],[
                'photo.max' => 'The image is too heavy. Standard size is 5mb',
                'discount120.gt' => 'Discount price for 120 days must be higher than that for 90 days',
                'discount90.gt' => 'Discount price for 90 days must be higher than that for 60 days',
                'discount60.gt' => 'Discount price for 60 days must be higher than that for 30 days',
                'lt' => 'This discount price must be less than actual price',
            ]);
            
            if($validator->fails()){
                return request()->expectsJson() ?
                 response()->json([
                    'status' => false,
                    'message'=> $validator->errors()->first()
                ], 401) :
                redirect()->back()->withErrors($validator)->withInput()->with(['result'=> '0','message'=> $validator->errors()->first()]);
            }
            $product = Product::where('id',$request->product_id)->where('shop_id',$request->shop_id)->first();
            if(!$product){
                return response()->json([
                    'status' => false,
                    'message' => 'Product does not exist',
                ], 401);
            }
            if($request->hasFile('photo')){
                if($product->photo) Storage::delete('public/'.$product->photo);
                $photo = 'uploads/'.time().'.'.$request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->storeAs('public/',$photo);
                $product->update(['photo'=> $photo]);
            } 
            $product->update(['name'=> $request->name,'shop_id'=> $product->shop_id,'description'=> $request->description,'stock'=> $request->stock,'category_id'=> $request->category_id, 'tags'=> $request->tags,'expire_at'=> Carbon::parse($request->expiry),'price'=> $request->price,'discount30'=> $request->discount30,'discount60'=> $request->discount60,'discount90'=> $request->discount90,'discount120'=> $request->discount120,'published'=> $request->published]);
            return request()->expectsJson()
                ? response()->json(['status' => true, 'message' => 'Product Updated Successfully','data'=> new ProductDetailsResource($product)], 200) :
                    redirect()->route('vendor.shop.product.list',$product->shop);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        
    }

    public function destroy(Request $request){
        // dd($request->all());
        $product = Product::find($request->product_id);
        if($product->shop_id != $request->shop_id){
            return request()->expectsJson() ?
                 response()->json([
                    'status' => false,
                    'message'=> 'Product does not belong to shop'
                ], 401) :
                redirect()->back()->with(['result'=> '0','message'=> 'Product does not belong to shop']);
        }
        if($product->orders->isNotEmpty() && OrderStatus::whereIn('order_id',$product->orders->pluck('order_id')->toArray())->count()){
            return request()->expectsJson() ?
                 response()->json([
                    'status' => false,
                    'message'=> 'Cannot delete products with on-going orders'
                ], 401) :
                redirect()->back()->with(['result'=> '0','message'=> 'Cannot delete products with on-going orders']);
        } 
        Product::where('id',$product->id)->delete();
        return request()->expectsJson() ?
                 response()->json([
                    'status' => true,
                    'message'=> 'Product Deleted Successfully'
                ], 200) :
                redirect()->back()->with(['result'=> '1','message'=> 'Product Deleted Successfully']);
        
        
    }

}
