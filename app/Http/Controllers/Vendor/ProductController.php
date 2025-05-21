<?php

namespace App\Http\Controllers\Vendor;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Store;
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
   
    public function index(Store $store){
        $products = Product::where('store_id',$store->id)->orderBy('expire_at','desc')->with('rejected')->get();
        return response()->json([
                'status' => true,
                'message' => $products->count() ? 'Products retrieved Successfully':'No Products retrieved',
                'data' => ProductResource::collection($products),
                'count' => $products->count()
            ], 200);
    }

    public function store(Store $store,Request $request){
        // dd($request->all());
         
        try {
            $date_limit = now()->addHours(config('settings.order_processing_to_shipment_period'));
            $validator = Validator::make($request->all(), 
            [
                'name' => 'required|string',  
                'category_id' => 'required|integer',  
                'photos' => 'nullable|array',  
                'photos.*' => 'nullable|image|max:5120',  
                'description' => 'string|nullable',  
                'meta_description' => 'string|nullable',  
                'pre_order' => 'boolean',  
                'always_available' => 'boolean',  
                'expiry_at' => ['nullable','date',"after:$date_limit",'before:2038-01-01'],  
                'expiry_term' => 'string|nullable',  
                'discount30' => 'numeric|nullable',  
                'discount60' => 'numeric|nullable',  
                'discount90' => 'numeric|nullable',  
                'discount120' => 'numeric|nullable',  
                'published' => 'boolean',  
                //'options' => 'array',  
                'options.*.id' => 'required|integer',  
                'options.*.values' => 'required|array',  
                // 'options.*.values.*' => 'string',  
                // 'variants' => 'array',  
                'variants.*.price' => 'required|numeric',  
                'variants.*.stock' => 'required|integer',  
                'variants.*.options' => 'required|array',  
                'variants.*.options.*.id' => 'required|integer',  
                'variants.*.options.*.value' => 'required|string',  
                'variants.*.photo' => 'nullable|image|max:5120',  
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message'=> $validator->errors()->first()
                ], 401);
            }
            
            // Process uploaded images
            $uploadedImages = [];
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $imageFile) {
                    $imagePath = 'products/' . time() . '_' . rand(1000, 9999) . '.' . $imageFile->getClientOriginalExtension();
                    $imageFile->storeAs('public', $imagePath);
                    $uploadedImages[] = $imagePath;
                }
            }
            
            // Create the product
            $product = Product::create([
                'name' => $request->name,
                'store_id' => $store->id,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'meta_description' => $request->meta_description,
                'photos' => $uploadedImages, // Database field is still 'photos'
                'preorder' => $request->pre_order ?? false,
                'always_available' => $request->always_available ?? false,
                'expire_at' => $request->expiry_at ? Carbon::parse($request->expiry_at) : null,
                'expiry_term' => $request->expiry_term,
                'discount30' => $request->discount30,
                'discount60' => $request->discount60,
                'discount90' => $request->discount90,
                'discount120' => $request->discount120,
                'published' => $request->published
            ]);
            
            // Process product options if provided
            if ($request->has('options') && is_array($request->options)) {
                foreach ($request->options as $option) {
                    $product->options()->create([
                        'product_attribute_id' => $option['id'],
                        'values' => $option['values']
                    ]);
                }
            }
            
            // Process variants if provided
            if ($request->has('variants') && is_array($request->variants)) {
                foreach ($request->variants as $index => $variant) {
                    $isDefault = $index === 0; // First variant is default
                    
                    // Handle variant image upload if present
                    $variantImagePath = null;
                    if (isset($variant['photo']) && $variant['photo']) {
                        $imageFile = $variant['photo'];
                        if (is_object($imageFile) && $imageFile instanceof \Illuminate\Http\UploadedFile) {
                            $variantImagePath = 'products/variants/' . time() . '_' . rand(1000, 9999) . '.' . $imageFile->getClientOriginalExtension();
                            $imageFile->storeAs('public', $variantImagePath);
                        }
                    }
                    
                    // Build variant name with attributes
                    $variantName = $product->name;
                    if (isset($variant['options']) && is_array($variant['options'])) {
                        foreach ($variant['options'] as $option) {
                            $variantName .= ' | ' . $option['value'];
                        }
                    }
                    
                    $product->variants()->create([
                        'name' => $variantName,
                        'price' => $variant['price'],
                        'stock' => $variant['stock'],
                        'options' => $variant['options'],
                        'photo' => $variantImagePath, // DB field is still 'photo'
                        'is_default' => $isDefault,
                        'is_active' => true,
                        'type' => 'product'
                    ]);
                }
            } else {
                // Create default variant if no variants specified
                $product->variants()->create([
                    'name' => $product->name,
                    'price' => $request->price ?? 0,
                    'stock' => $request->stock ?? 0,
                    'options' => [],
                    'is_default' => true,
                    'is_active' => true,
                    'type' => 'product'
                ]);
            }
            
            return response()->json([
                    'status' => true, 
                    'message' => 'Product Created Successfully',
                    'data' => new ProductDetailsResource($product)
                ], 200);
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function edit(Store $store,Product $product){
        $tags = Tag::all();
        return view('vendor.store.product.edit',compact('store','product','tags'));
    }

    public function update(Store $store,Request $request){
        // dd($request->all());
        try {
            $date_limit = now()->addHours(cache('settings')['order_processing_to_delivery_period']);
            $date_beyond = Carbon::parse('2038-01-01');
            $validator = Validator::make($request->all(), 
            [
                'product_id' => 'required|numeric',
                'store_id' => 'required|numeric',
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
            
            $product = Product::where('id',$request->product_id)->where('store_id',$request->store_id)->first();
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
                    redirect()->route('vendor.store.product.list',$product->store)->with(['result'=>1,'message'=> 'Product Updated Successfully']);
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
        if($product->store_id != $request->store_id){
            return request()->expectsJson() ?
                 response()->json([
                    'status' => false,
                    'message'=> 'Product does not belong to store'
                ], 401) :
                redirect()->back()->with(['result'=> '0','message'=> 'Product does not belong to store']);
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


    public function download_template(Store $store){
        return Excel::download(new ProductsTemplateExport($store), 'product_template.xlsx');
    }

    public function upload(Store $store,Request $request){
        try {
            Excel::import(new ProductsImport($store->id), $request->file('products'));
        }
        catch(\Maatwebsite\Excel\Validators\ValidationException $e){
            $failures = $e->failures();
            dd($failures);
        }
        return redirect()->route('vendor.store.product.list',$store)->with(['result'=>1,'message'=> 'Products Uploaded Successfully']);
    }

    public function details(Store $store,Product $product){
        if($product && $store && $product->store_id == $store->id){
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
