<?php

namespace App\Http\Controllers\Admin;


use App\Models\Country;
use App\Models\Product;
use App\Models\Rejection;
use Illuminate\Http\Request;
use App\Http\Traits\SecurityTrait;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeoLocationTrait;


class ProductController extends Controller
{
    use GeoLocationTrait,SecurityTrait;
    
    public function __construct(){
        $this->middleware('auth')->except(['index','show','getSubcategories']);
    }
    
    public function index(){
        $country_id = null;
        $status = 'all';
        $sortBy = null;
        $name = null;
        $products = Product::within();
        if(request()->query() && request()->query('name')){
            $name = request()->query('name');
            $products = $products->where(function($query) use($name) {
                $query->where('name','LIKE',"%$name%")->orWhereHas('shop',function($qry) use($name){ $qry->where('name','LIKE',"%$name%");});});
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id');
            $products = $products->whereHas('shop',function($quey) use($country_id){
                $quey->where('country_id',$country_id);
            });
        }else{
            $country_id = 0;
        }
        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status');
            if($status == 'live')
            $products = $products->live()->isAccessible();
            if($status == 'pending')
            $products = $products->where('approved',false)->isNotRejected();
            if($status == 'rejected')
            $products = $products->has('rejected');
            if($status == 'inactive')
            $products = $products->where('status',false);
            if($status == 'draft')
            $products = $products->where('published',false);
            if($status == 'expired')
            $products = $products->where('expire_at','<',now());
            if($status == 'soldout')
            $products = $products->where('stock','<',cache('settings')['maximum_stock_level']);
            if($status == 'inaccessible')
            $products = $products->whereHas('shop',function ($q) { $q->where('status',false)->orWhere('approved',false)->orWhere('published',false); } );
        }

        if(request()->query() && request()->query('from_date')){
            $from_date = request()->query('from_date');
            $products = $products->where('created_at','>=',$from_date);
        }
        if(request()->query() && request()->query('to_date')){
            $to_date = request()->query('to_date');
            $products = $products->where('created_at','<=',$to_date);
        }
        
        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'name_asc'){
                $products = $products->orderBy('name','asc');
            }
            if(request()->query('sortBy') == 'name_desc'){
                $products = $products->orderBy('name','desc');
            }
            if(request()->query('sortBy') == 'date_asc'){
                $products = $products->orderBy('expire_at','asc');
            }
            if(request()->query('sortBy') == 'date_desc'){
                $products = $products->orderBy('expire_at','desc');
            }

            
        }
        
        $countries = Country::all();
        $products = $products->paginate(16);
        $min_date = $products->total() ? $products->min('created_at')->format('Y-m-d') : null;
        $max_date = $products->total() ? $products->max('created_at')->format('Y-m-d') : null;
        return view('admin.products',compact('products','min_date','max_date','countries','country_id','status','name','sortBy'));
    }

    public function manage(Request $request){
         
        if(!$this->checkPin($request)['result']){
            return redirect()->back()->with(['result'=> $this->checkPin($request)['result'],'message'=> $this->checkPin($request)['message']]);
        }
        /** @var \App\Models\User $user **/
        $user = auth()->user(); 
        if($request->delete && $user->isRole('superadmin')){
            $products = Product::whereIn('id',$request->products)->whereDoesntHave('orders')->delete();
            return redirect()->back()->with(['result'=>1,'message'=> 'Products deleted Successfully']);
        }elseif($request->approved){
            // dd($request->all());
            $products = Product::whereIn('id',$request->products)->update(['approved'=> $request->approved]);
            Rejection::whereIn('rejectable_id',$request->products)->where('rejectable_type','App\Models\Product')->delete();
            return redirect()->back()->with(['result'=>1,'message'=> 'Products updated Successfully']);
        }else{
            $product = Product::find($request->product_id);
            $product->rejected()->create(['reason'=> $request->reason,'rejectable_id'=> $product->id,'rejectable_type' => get_class($product)]);
            return redirect()->back()->with(['result'=>1,'message'=> 'Products rejected Successfully']);
        }
        
    }

    

}
