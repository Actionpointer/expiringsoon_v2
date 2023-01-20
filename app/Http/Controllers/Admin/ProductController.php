<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Shop;
use App\Models\State;
use App\Models\Advert;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
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
}
