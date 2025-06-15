<?php

namespace App\Http\Controllers\Guest;

use App\Models\State;
use App\Models\Country;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;

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

    public function states(){
        $country_id = request()->query('country_id');
        if($country_id){
            $states = State::where('country_id',$country_id)->get();
        }
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

    public function cities(){
        $country_id = request()->query('country_id');
        $state_id = request()->query('state_id');
        if($country_id){
            $country = Country::find($country_id);
            $cities = $country->cities;
        }    
        else if($state_id){
            $state = State::find($state_id);
            $cities = $state->cities;
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

    public function attributes(){
        $attributes = ProductAttribute::all();
        if(!$attributes || $attributes->count() == 0){
            return response()->json([
                'status' => true,
                'message' => 'No Attribute retrieved',
                'data' => null
            ], 200);
        }
        
        return response()->json([
                'status' => true,
                'message' => 'Attributes retrieved Successfully',
                'data' => $attributes,
                'count' => $attributes->count()
        ], 200);
    }  

    public function coupon(Request $request){
        $code = $request->code;
        $amount = $request->amount;
        return $this->getCoupon($code,$amount);
    }
  
}
