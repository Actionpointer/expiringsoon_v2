<?php

namespace App\Http\Controllers\Customer;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('auth:sanctum')->only('review');
    }
    
    public function reviews(Product $product){
        $reviews = Review::where('product_id',$product->id)->paginate(16);
        if(request()->expectsJson()){
            return response()->json([
                'status' => true,
                'message' => 'Reviews Retrieved',
                'data' => ReviewResource::collection($reviews),
                'meta'=> [
                    "total"=> $reviews->total(),
                    "per_page"=> $reviews->perPage(),
                    "current_page"=> $reviews->currentPage(),
                    "last_page"=> $reviews->lastPage(),
                    "first_page_url"=> $reviews->url(1),
                    "last_page_url"=> $reviews->url($reviews->lastPage()),
                    "next_page_url"=> $reviews->nextPageUrl(),
                    "prev_page_url"=> $reviews->previousPageUrl(),
                ]
                
            ], 200);
        }else{
            return view('frontend.product.reviews',compact('reviews'));
        }
    }

    public function review(Request $request){
        $product = Product::find($request->product_id);
        if($product->reviewable()){
            $review = Review::create(['product_id'=> $request->product_id,'user_id'=> auth()->id(),'rating'=> $request->rating,'comment'=> $request->comment]);
            return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Review Added Successfully',
            ], 200):
            redirect()->back()->with(['result'=> 1,'message'=> 'Review successfully added']); 
        }else{
            return request()->expectsJson() ? 
            response()->json([
                'status' => false,
                'message' => 'Review Could Not Be Saved',
            ], 401):
            redirect()->back()->with(['result'=> 1,'message'=> 'Review Could Not Be Saved']); 
        }
        
    }

}
