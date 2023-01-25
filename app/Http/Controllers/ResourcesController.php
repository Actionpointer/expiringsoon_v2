<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Plan;
use App\Models\State;
use App\Models\Category;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $categories = Category::select('id','name')->get();
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

    public function tags($category_id)
    {
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

    public function states()
    {
        $states = State::select('id','name','iso')->get();
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cities($state_id)
    {
        $cities = City::where('state_id',$state_id)->select('id','name')->get();
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
