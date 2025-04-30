<?php

namespace App\Http\Controllers\Vendor;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Shop;
use App\Models\Product;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsTemplateExport;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductDetailsResource;
use App\Http\Traits\OptimizationTrait;

class ProductController extends Controller
{
    use OptimizationTrait;
    public function __construct(){
        $this->middleware('auth:sanctum');
    }
   
    public function index(Shop $shop){
        $products = Product::where('shop_id',$shop->id)->orderBy('expire_at','desc')->with('rejected')->get();
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
        $tags = Tag::all(); 
        return view('vendor.shop.product.create',compact('shop','tags'));
    }

    public function store(Shop $shop,Request $request){
        try {
            $date_limit = now()->addHours(cache('settings')['order_processing_to_delivery_period']);
            $date_beyond = Carbon::parse('2038-01-01');
            $validator = Validator::make($request->all(), 
            [
                'shop_id' => 'required|numeric',
                'name' => 'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric',
                'stock' => 'required|numeric|gt:1',
                'tags' => 'nullable',
                'photo' => 'nullable|max:5120|image',
                'expiry' => ['nullable','date',"after:$date_limit","before:$date_beyond"],   
            ],[
                'photo.max' => 'The image is too heavy. Standard size is 5mb',
            ]);
            if($validator->fails()){
                return request()->expectsJson() ?
                 response()->json([
                    'status' => false,
                    'message'=> $validator->errors()->first()
                ], 401) :
                redirect()->back()->withErrors($validator)->withInput()->with(['result'=> '0','message'=> $validator->errors()->first()]);
            }
            $photo = '';
            if($request->hasFile('photo')){
                $photo = $this->imageUpload($request->file('photo'));
            }
            $length = $width = $height = $weight = null;
            if($request->length || $request->width || $height){

            }
            $product = Product::create(['name'=> $request->name,'shop_id'=> $shop->id,
            'description'=> $request->description,'stock'=> $request->stock,
            'tags'=> $request->tags ?? [],'photo'=> $photo,'expire_at'=> $request->expiry? Carbon::parse($request->expiry):null,
            'price'=> $request->price,'discount30'=> $request->discount30,'discount60'=> $request->discount60,
            'discount90'=> $request->discount90,'discount120'=> $request->discount120,'published'=> $request->published,
            'length'=> $request->length,'width'=> $request->width,'height'=> $request->height,'weight'=> $request->weight,'units'=> [$request->length_unit,$request->weight_unit]]);
            
            return request()->expectsJson()
                ? response()->json(['status' => true, 'message' => 'Product Created Successfully'], 200) :
                    redirect()->route('vendor.shop.product.list',$shop)->with(['result'=>1,'message'=> 'Product Created Successfully']);
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    
    }

    public function edit(Shop $shop,Product $product){
        $tags = Tag::all();
        return view('vendor.shop.product.edit',compact('shop','product','tags'));
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
                'price' => 'required|numeric',
                'stock' => 'required|numeric|gt:1',
                'tags' => 'nullable',
                'photo' => 'nullable|max:5120|image',
                'expiry' => ['nullable','date',"after:$date_limit","before:$date_beyond"], 
            ],[
                'photo.max' => 'The image is too heavy. Standard size is 5mb',
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
            $photo = '';
            if($request->hasFile('photo')){
                if($product->photo) Storage::delete('public/'.$product->photo);
                $photo = $this->imageUpload($request->file('photo'));
                $product->photo = $photo;
            } 
            $product->name = $request->name;
            $product->description = $request->description;
            $product->stock = $request->stock;
            $product->tags = $request->tags ?? [];
            $product->name = $request->name;
            $product->price = $request->price;
            $product->expire_at = $request->expiry? Carbon::parse($request->expiry):null;
            $product->discount30 = $request->discount30;
            $product->discount60 = $request->discount60;
            $product->discount90 = $request->discount90;
            $product->discount120 = $request->discount120;
            $product->published = $request->published;
            $product->length = $request->length;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->weight = $request->weight;
            $product->units = [$request->length_unit,$request->weight_unit];
            $product->approved = false;
            $product->save();
            $product->rejections()->delete();
            return request()->expectsJson()
                ? response()->json(['status' => true, 'message' => 'Product Updated Successfully','data'=> new ProductDetailsResource($product)], 200) :
                    redirect()->route('vendor.shop.product.list',$product->shop)->with(['result'=>1,'message'=> 'Product Updated Successfully']);
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

    public function upload(Shop $shop){
        $tags = Tag::all(); 
        return view('vendor.shop.product.upload',compact('shop','tags'));
    }

    public function download_template(Shop $shop){
        return Excel::download(new ProductsTemplateExport($shop), 'product_template.xlsx');
    }

    public function upload(Shop $shop,Request $request){
        try {
            Excel::import(new ProductsImport($shop->id), $request->file('products'));
        }
        catch(\Maatwebsite\Excel\Validators\ValidationException $e){
            $failures = $e->failures();
            dd($failures);
        }
        return redirect()->route('vendor.shop.product.list',$shop)->with(['result'=>1,'message'=> 'Products Uploaded Successfully']);
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

    

}
