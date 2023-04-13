<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Category;

class ResourcesController extends Controller
{
    
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

    public function location(){
        $location = session('locale');
        return response()->json([
            'status' => true,
            'message' => 'User Geo information returned',
            'data' => $location,
        ], 200);
    }

    public function states($country_id = null){
        if($country_id)
            $states = State::where('country_id',$country_id)->select('id','name','iso')->get();
        else
            $states = State::within()->select('id','name','iso')->get();
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

    public function cities(State $state){
        $cities = City::where('state_id',$state->id)->select('id','name')->get();
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
                'message' => 'No State retrieved',
                'data' => null,
                'count' => 0
            ], 200);
        }
    }

    
    
    
}
