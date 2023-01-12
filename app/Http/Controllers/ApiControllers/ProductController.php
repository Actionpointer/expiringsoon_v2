<?php

namespace App\Http\Controllers\ApiControllers;

use Carbon\Carbon;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shop_id){
        $user = auth()->user();
        $shop = Shop::find($shop_id);
        if($shop && $shop->owner()->id == $user->id){
            $products = Product::where('shop_id',$shop_id)->orderBy('expire_at','desc')->get();
            if($products->count()){
                return response()->json([
                    'status' => true,
                    'message' => 'Products retrieved Successfully',
                    'data' => $products,
                    'count' => $products->count()
                ], 200);
            }else{
                return response()->json([
                    'status' => true,
                    'message' => 'No Product retrieved',
                    'data' => null,
                    'count' => 0
                ], 200);
            }   
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Shop does not exist',
                'data' => null,
                'count' => 0
            ], 200);
        }   
    }

    
    public function store(Request $request)
    {
        try {

            $rule = [
                'discount120.gt' => 'This discount must be greater than 61 to 90 days discount',
                'discount90.gt' => 'This discount must be greater than 31 to 60 days discount',
                'discount60.gt' => 'This discount must be greater than 1 to 31 days discount',
                'lt' => 'This discount price must be less than actual price',
            ];
            $validateUser = Validator::make($request->all(), 
                [   
                    'shop_id' => 'required|string',
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'stock' => 'required|numeric|gt:1',
                    'category_id' => 'required|numeric',
                    'tags' => 'nullable|string',
                    // 'photo_url' => 'required|string',
                    // 'photo_extension' => 'required|string',
                    'expiry' => 'required|date|after:today',
                    'price' => 'required|numeric',
                    'discount120' => 'nullable|lt:price|gt:discount90',
                    'discount90' => 'nullable|lt:price|gt:discount60',
                    'discount60' => 'nullable|lt:price|gt:discount30',
                    'discount30' => 'nullable|lt:price',  
                ],$rule);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors()->first()
                ], 401);
            }
            
            // $photo = 'uploads/'.time().'.'.$request->photo_extension;
            // $response = Curl::to($request->photo_url)->withContentType('image/png')->download('storage/'.$photo);
            // if(!$response) $photo = null;
            
            $product = Product::create(['name'=> $request->name,'shop_id'=> $request->shop_id,'description'=> $request->description,'stock'=> $request->stock,'category_id'=> $request->category_id, 'tags'=> explode(',',$request->tags),'photo'=> 'uploads/1631376036.jpg','expire_at'=> Carbon::parse($request->expiry),'price'=> $request->price,'discount30'=> $request->discount30,'discount60'=> $request->discount60,'discount90'=> $request->discount90,'discount120'=> $request->discount120,
                'published'=> 1]);
            return response()->json([
                'status' => true,
                'message' => 'Product Created Successfully',
                'data' => ['product_id'=> $product->id,'name'=> $product->name,'shop'=> $product->shop->name,'create_products_remaining'=> $product->shop->owner()->allowedProducts()]
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    
    public function show($id)
    {
        $product = Product::find($id);
        if($product && $product->shop->owner()->id == auth()->id()){
            return response()->json([
                'status' => true,
                'message' => 'Shop retrieved Successfully',
                'data' => $product
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Product does not exist',
                'data' => null,
                'count' => 0
            ], 200);
        }
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
}
