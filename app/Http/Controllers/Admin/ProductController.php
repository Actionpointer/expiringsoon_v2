<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $products = Product::where('published',true)->orderBy('expire_at','desc')->get();
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

    public function categories_management(Request $request){
        if($request->category_id){
            $category = Category::find($request->category_id);
            if($request->delete){
                if($category->products->count()){
                    return redirect()->back()->with(['result'=> 0,'message'=> 'Unable to delete category which has products']);
                }
                $category->subcategories->detach();
                $category->delete();

                
            }else{
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
        }else{
            $category = Category::create(['name'=> $request->category]);
            foreach($request->tags as $tag){
                if(is_numeric($tag)){
                    $category->subcategories->attach($tag);
                }else{
                    $newtag = Tag::create(['name'=> $tag]);
                    $category->subcategories->attach($newtag->id);
                }
            }
        }
    }
}
