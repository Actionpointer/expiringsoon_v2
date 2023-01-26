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
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth:sanctum');
    }
   
    public function index(Shop $shop){
        $products = Product::where('shop_id',$shop->id)->orderBy('expire_at','desc')->get();
        return view('vendor.shop.product.list',compact('shop','products'));
    }

    public function list($shop_id){
        $products = Product::where('shop_id',$shop_id)->orderBy('expire_at','desc')->get();
        return response()->json([
            'status' => true,
            'message' => $products->count() ? 'Products retrieved Successfully':'No Products retrieved',
            'data' => ProductResource::collection($products),
            'count' => $products->count()
        ], 200);
    }

    public function create(Shop $shop){
        $categories = Category::all();
        $tags = Tag::all(); 
        return view('vendor.shop.product.create',compact('shop','categories','tags'));
    }

    public function details($shop_id,$product_id){
        $product = Product::find($product_id);
        if($product && $product->shop_id == $shop_id){
            return response()->json([
                'status' => true,
                'message' => 'Products retrieved Successfully',
                'data' => new ProductResource($product)
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
        try {
            $validator = Validator::make($request->all(), 
            [
                'shop_id' => 'required|numeric',
                'name' => 'required|max:255',
                'description' => 'required',
                'stock' => 'required|numeric|gt:1',
                'category_id' => 'required|numeric',
                'tags' => 'nullable',
                'photo' => 'required|max:2048|image',
                'expiry' => 'required|date|after:today',
                'price' => 'required|numeric',
                'discount120' => 'nullable|lt:price|gt:discount90',
                'discount90' => 'nullable|lt:price|gt:discount60',
                'discount60' => 'nullable|lt:price|gt:discount30',
                'discount30' => 'nullable|lt:price',    
                'published' => 'required|numeric',   
            ],[
                'photo.max' => 'The image is too heavy. Standard size is 2mb',
                'discount120.gt' => 'This discount must be greater than 61 to 90 days discount',
                'discount90.gt' => 'This discount must be greater than 31 to 60 days discount',
                'discount60.gt' => 'This discount must be greater than 1 to 31 days discount',
                'lt' => 'This discount price must be less than actual price',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validator->errors()->first()
                ], 401);
            }
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
            $validator = Validator::make($request->all(), 
            [
                'product_id' => 'required|numeric',
                'shop_id' => 'required|numeric',
                'name' => 'required|max:255',
                'description' => 'required',
                'stock' => 'required|numeric|gt:1',
                'category_id' => 'required|numeric',
                'tags' => 'nullable',
                'photo' => 'nullable|max:2048|image',
                'expiry' => 'required|date|after:today',
                'price' => 'required|numeric',
                'discount120' => [Rule::requiredIf(isset($request->discount90)),'numeric','lt:price','gt:discount90'],
                'discount90' => [Rule::requiredIf(isset($request->discount60)),'numeric','lt:price','gt:discount60'],
                'discount60' => [Rule::requiredIf(isset($request->discount30)),'numeric','lt:price','gt:discount30'],
                'discount30' => 'nullable|lt:price',   
                'published' => 'required|numeric',  
            ],[
                'photo.max' => 'The image is too heavy. Standard size is 2mb',
                'discount120.gt' => 'This discount must be greater than 61 to 90 days discount',
                'discount90.gt' => 'This discount must be greater than 31 to 60 days discount',
                'discount60.gt' => 'This discount must be greater than 1 to 31 days discount',
                'lt' => 'This discount price must be less than actual price',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validator->errors()->first()
                ], 401);
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
                ? response()->json(['status' => true, 'message' => 'Product Updated Successfully'], 200) :
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
        // $products = Product::whereIn('id',$request->products)->where('shop_id',$request->shop_id)->delete();
        // if($request->delete){
        //     foreach($products as $product){
        //         if($product->carts->isEmpty()){
        //             $product->delete();
        //         }
        //     }    
        //     return redirect()->back()->with(['result'=> 1,'message'=> 'Deleted Successfully']);
        // }
        
    }

}
