<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Traits\GeoLocationTrait;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use GeoLocationTrait;
    public function __construct(){
        $this->middleware('auth')->except(['index','show','getSubcategories']);
    }
    
    public function index()
    {
        $products = Product::orderBy('expire_at','desc')->get();
        return view('admin.products',compact('products'));
    }

    public function manage(Request $request){
        if($request->delete){
            $products = Product::whereIn('id',$request->products)->whereDoesntHave('orders')->get();
            $products->each->delete();
            return redirect()->back()->with(['result'=>1,'message'=> 'Products deleted Successfully']);
        }else{
            $products = Product::whereIn('id',$request->products)->update(['status'=> $request->approved]);
        }
        return redirect()->back()->with(['result'=>1,'message'=> 'Products updated Successfully']);
    }

    public function categories(){
        $categories = Category::all();
        $tags = Tag::all();
        // dd($tags);
        return view('admin.categories',compact('categories','tags'));
    }

    public function category_store(Request $request){
        $file = $request->file('photo') ;
        $fileName = time().'.'.$request->file('photo')->getClientOriginalExtension();
        $destinationPath = public_path().'/src/images/categories' ;
        $file->move($destinationPath,$fileName);
        $category = Category::create(['name'=> $request->category,'photo'=> $fileName]);
        foreach($request->tags as $tag){
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
        $old_subs = Arr::where($request->tags, function ($value, $key) {
            return is_numeric($value) ;
        });
        $new_subs = Arr::where($request->tags, function ($value, $key) {
            return is_string($value);
        });
        $category->subcategories->sync($old_subs);
        foreach($new_subs as $sub){
            $newtag = Tag::create(['name'=> $sub]);
            $category->subcategories->attach($newtag->id);
        }
    }
    public function category_destroy(Request $request){
        $category = Category::find($request->category_id);
        if($category->products->count()){
            return redirect()->back()->with(['result'=> 0,'message'=> 'Unable to delete category which has products']);
        }
        $category->subcategories()->detach();
        $image_path = public_path("src/images/categories/{{$category->photo}}");
        if (File::exists($image_path)) {
            // File::delete($image_path);
            unlink($image_path);
        }
        $category->delete();
        return redirect()->back();
    }

}
