<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function index(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('settings.categories.index',compact('categories','tags'));
    }

    public function category_store(Request $request){
        $file = $request->file('photo') ;
        $fileName = time().'.'.$request->file('photo')->getClientOriginalExtension();
        $destinationPath = public_path().'/src/images/categories' ;
        $file->move($destinationPath,$fileName);
        $category = Category::create(['name'=> $request->category,'photo'=> $fileName]);
        foreach($request->subcategories as $tag){
            if(is_numeric($tag)){
                $category->subcategories()->attach($tag);
            }else{
                $newtag = Tag::create(['name'=> $tag]);
                $category->subcategories()->attach($newtag->id);
            }
        }
        return redirect()->back();
    }

    public function category_update(Request $request){
        $category = Category::find($request->category_id);
        if($request->hasFile('photo')){
            $image_path = public_path("src/images/categories/{{$category->photo}}");
            if(File::exists($image_path)) {
                unlink($image_path);
            }
            $file = $request->file('photo');
            $fileName = time().'.'.$request->file('photo')->getClientOriginalExtension();
            $destinationPath = public_path().'/src/images/categories' ;
            $file->move($destinationPath,$fileName);
            $category->photo = $fileName;
        }
        $category->name = $request->category;
        $category->save();
        $old_subs = Arr::where($request->subcategories, function ($value, $key) {
            return is_numeric($value) ;
        });
        $category->subcategories()->sync($old_subs);
        $new_subs = Arr::where($request->subcategories, function ($value, $key) {
            return !is_numeric($value);
        });
        foreach($new_subs as $sub){
            $newtag = Tag::create(['name'=> $sub]);
            $category->subcategories()->attach($newtag->id);
        }
        return redirect()->back();
    }
    
    public function category_destroy(Request $request){
        $category = Category::find($request->category_id);
        $category->subcategories()->detach();
        $image_path = public_path("src/images/categories/{{$category->photo}}");
        if (File::exists($image_path)) {
            // File::delete($image_path);
            unlink($image_path);
        }
        $category->delete();
        return redirect()->back();
    }

    public function tag_store(Request $request){
        $tag = Tag::create(['name'=> $request->tag]);
        foreach($request->categories as $category){
             $tag->categories()->attach($category);
        }
        return redirect()->back();
    }

    public function tag_update(Request $request){
        $tag = Tag::find($request->tag_id);
        $tag->name = $request->tag;
        $tag->save();
        $tag->categories()->sync($request->categories);
        return redirect()->back();
    }
    
    public function tag_destroy(Request $request){
        $tag = Tag::find($request->tag_id);
        $tag->categories()->detach();
        $products = Product::where('tags','LIKE',"%$tag->name%")->get();
        foreach($products as $product){
            $product->tags = Str::remove($tag->name, $product->tags);
            $product->save();
        }
        $tag->delete();
        return redirect()->back();
    }
}
