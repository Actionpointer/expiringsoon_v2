<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Resources\CountryResource;
use App\Models\Location;

class ResourcesController extends Controller
{
    use OrderTrait;

    public function countries(){
        $countries = Country::all();
        if($countries->count()){
            return response()->json([
                'status' => true,
                'message' => 'Countries retrieved Successfully',
                'data' => CountryResource::collection($countries),
                'count' => $countries->count()
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'No Country retrieved',
                'data' => null,
                'count' => 0
            ], 200);
        }
    }

    public function states($country_id = null){
        if($country_id)
            $states = State::where('country_id',$country_id)->get();
        else{
            //get the state where the user is browsing from location table
            $location = Location::where('ip',request()->ip())->first();
            if($location){
                $states = State::where('country_id',$location->country_id)->get();
            }else{
                $states = collect([]);
            }
        }
            
        if($states->count()){
            return response()->json([
                'status' => true,
                'message' => 'States retrieved Successfully',
                'data' => $states,
                'count' => $states->count()
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'No State retrieved',
                'data' => null,
                'count' => 0
            ], 200);
        }
    }

    public function cities($country_id = null){
        if($country_id){
            $country = Country::find($country_id);
            $cities = $country->cities;
        }    
        else{
            //get the state where the user is browsing from location table
            $location = Location::where('ip',request()->ip())->first();
            if($location){
                $country = Country::find($location->country_id);
                $cities = $country->cities;
            }else{
                $cities = collect([]);
            }
        }
            
        if($cities->count()){
            return response()->json([
                'status' => true,
                'message' => 'Cities retrieved Successfully',
                'data' => $cities,
                'count' => $cities->count()
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'No City retrieved',
                'data' => null,
                'count' => 0
            ], 200);
        }
    }

    public function location(){
        $location = Location::where('ip',request()->ip())->first();
        return response()->json([
            'status' => true,
            'message' => 'User Geo information returned',
            'data' => $location,
        ], 200);
    }

    public function categories(){
        $categories = Category::all();
        if($categories->count()){
            return response()->json([
                'status' => true,
                'message' => 'Categories retrieved Successfully',
                'data' => $categories,
                'count' => $categories->count()
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'No Category retrieved',
                'data' => null,
                'count' => 0
            ], 200);
        }
    }

    public function tags($category_id){
        $category = Category::find($category_id);
        if(!$category){
            return response()->json([
                'status' => true,
                'message' => 'Category does not exist',
                'data' => null
            ], 200);
        }
        $tags = $category->subcategories;
        if($tags->count()){
            return response()->json([
                'status' => true,
                'message' => 'Tags retrieved Successfully',
                'data' => $tags,
                'count' => $tags->count()
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'No Tags available for selected category',
                'data' => null,
                'count' => 0
            ], 200);
        }
    }  

    public function coupon(Request $request){
        $code = $request->code;
        $amount = $request->amount;
        return $this->getCoupon($code,$amount);
    }
  
}
