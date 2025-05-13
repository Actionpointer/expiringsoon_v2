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
        // Get all categories for statistics
        $allCategories = Category::all();
        
        // Get paginated categories for display
        $categories = Category::with('products')->paginate(10);
        
        // Calculate statistics from the full collection
        $active_categories = $allCategories->where('is_active', 1)->count();
        
        // Get unique groups for filtering
        $groups = $allCategories->pluck('group_by')->unique()->filter();
        
        // Get total product count
        $product_count = $allCategories->sum('products_count');
        
        return view('settings.categories.index', compact(
            'categories',
            'active_categories',
            'groups',
            'product_count'
        ));
    }

    public function store(Request $request){
        // dd($request->all());
        $file = $request->file('photo') ;
        $fileName = time().'.'.$request->file('photo')->getClientOriginalExtension();
        $destinationPath = public_path().'/images/categories';
        $file->move($destinationPath,$fileName);
        $category = Category::create(['name'=> $request->name,'description'=> $request->description,'photo'=> $fileName,'is_active'=> $request->is_active,'group_by'=> $request->group_by]);
        
        return redirect()->back();
    }

    public function update(Request $request){
        $category = Category::find($request->category_id);
        if($request->hasFile('photo')){
            $image_path = public_path("images/categories/{{$category->photo}}");
            if(File::exists($image_path)) {
                unlink($image_path);
            }
            $file = $request->file('photo');
            $fileName = time().'.'.$request->file('photo')->getClientOriginalExtension();
            $destinationPath = public_path().'/images/categories' ;
            $file->move($destinationPath,$fileName);
            $category->photo = $fileName;
        }
        $category->name = $request->name;
        $category->description = $request->description;
        $category->is_active = $request->is_active;
        $category->group_by = $request->group_by;
        $category->save();
        
        return redirect()->back();
    }
    
    public function destroy(Request $request){
        $category = Category::find($request->category_id);
        $category->subcategories()->detach();
        $image_path = public_path("images/categories/{{$category->photo}}");
        if (File::exists($image_path)) {
            // File::delete($image_path);
            unlink($image_path);
        }
        $category->delete();
        return redirect()->back();
    }
}
