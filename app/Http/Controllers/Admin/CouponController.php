<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Exports\CouponsExport;
use App\Http\Traits\OrderTrait;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class CouponController extends Controller
{
    use OrderTrait;

    public function list(){

        $name = null;
        $country_id = null;
        $role = 'all';
        $status = 'all';
        $sortBy = null;
        $coupons = Coupon::within();
        if(request()->query() && request()->query('status') && request()->query('status') != 'all'){
            $status = request()->query('status') == 'true' ? 1 : 0;
            $coupons = $coupons->where('status',$status);
        }
        if(request()->query() && request()->query('role') && request()->query('role') != 'all'){
            $role = request()->query('role');
            $coupons = $coupons->where('role',$role);
        }
        if(request()->query() && request()->query('country_id')){
            $country_id = request()->query('country_id') == 'global' ? null : request()->query('country_id');
            $coupons = $coupons->where('country_id',$country_id);
        }else{
            $country_id = 0;
        }

        if(request()->query() && request()->query('name')){
            $name = request()->query('name');
            $coupons = $coupons->where('name','LIKE',"%$name%");
        }
        if(request()->query() && request()->query('from_date')){
            $from_date = request()->query('from_date');
            $coupons = $coupons->where('created_at','>=',$from_date);
        }
        if(request()->query() && request()->query('to_date')){
            $to_date = request()->query('to_date');
            $coupons = $coupons->where('created_at','<=',$to_date);
        }

        if(request()->query() && request()->query('sortBy')){
            $sortBy = request()->query('sortBy');
            if(request()->query('sortBy') == 'date_asc'){
                $coupons = $coupons->orderBy('start_at','asc');
            }
            if(request()->query('sortBy') == 'date_desc'){
                $coupons = $coupons->orderBy('start_at','desc');
            }
            
        }
        $countries = Country::all();
        if(request()->query() && request()->query('download')){
            return Excel::download(new CouponsExport($coupons->get()), 'coupons.xlsx');
        }
        $coupons = $coupons->paginate(16);
        
        $min_date = $coupons->total() ? $coupons->min('start_at')->format('Y-m-d') : null;
        $max_date = $coupons->total() ? $coupons->max('start_at')->format('Y-m-d') : null;
        return view('admin.coupons.index',compact('coupons','min_date','max_date','countries','country_id','status','name','role','sortBy'));

    }

    public function store(Request $request){
        $coupon = Coupon::create([
            'name' => $request->title,
            'code' => $request->code,
            'start_at' => $request->start_date ? Carbon::createFromFormat('Y-m-d',$request->start_date): null,
            'end_at' => $request->end_date ? Carbon::createFromFormat('Y-m-d',$request->end_date): null,
            'quantity' => $request->quantity,
            'available' => $request->quantity,
            'is_percentage' => $request->type == 'percent' ? true:false,
            'value' => $request->value,
            'maximum_spend' => $request->maximum_spend ? $request->maximum_spend : null,
            'minimum_spend' => $request->minimum_spend ? $request->minimum_spend : null,
            'limit_per_user' => $request->per_customer ? $request->per_customer : null,
            'role' => $request->role,
            'country_id' => $request->country_id ? $request->country_id : null,
            'status' => $request->status ? true:false,
        ]);
       
        return redirect()->route('admin.coupons')->with(['result' => 1,'message' => 'Coupon Created Successfully']);
    }
    
    public function update(Request $request){
        // dd($request->all());
        $coupons = Coupon::where('id',$request->coupon_id)->update([
            'name' => $request->title,
            'code' => $request->code,
            'start_at' => $request->start_date ? Carbon::createFromFormat('Y-m-d',$request->start_date): null,
            'end_at' => $request->end_date ? Carbon::createFromFormat('Y-m-d',$request->end_date): null,
            'quantity' => $request->quantity,
            'available' => $request->quantity,
            'is_percentage' => $request->type == 'percent' ? true:false,
            'value' => $request->value,
            'maximum_spend' => $request->maximum_spend ?? $request->maximum_spend,
            'minimum_spend' => $request->minimum_spend ?? $request->minimum_spend,
            'limit_per_user' => $request->per_customer ?? $request->per_customer,
            'role' => $request->role,
            'country_id' => $request->country_id ?? $request->country_id,
            'status' => $request->status ? true:false,
        ]);
        return redirect()->route('admin.coupons')->with(['result' => 1,'message' => 'Coupon Updated Successfully']);
    }

    // public function update(Coupon $coupon,Request $request){
    //      dd($request->all());
    //     $coupon->name= $request->name;
    //     $coupon->code= $request->code;
    //     $coupon->start_at= $request->start_date ? Carbon::createFromFormat('m/d/Y',$request->start_date): null;
    //     $coupon->end_at= $request->end_date ? Carbon::createFromFormat('m/d/Y',$request->end_date): null;
    //     $coupon->quantity= $request->quantity;
    //     $coupon->available= $request->quantity;
    //     $coupon->is_percentage= $request->type == 'percent' ? true:false;
    //     $coupon->value= $request->value;
    //     $coupon->maximum_spend = $request->maximum_spend;
    //     $coupon->minimum_spend = $request->minimum_spend;
    //     $coupon->free_shipping= $request->shipping ? true:false;
    //     $coupon->category_limit= $request->categories ? $request->categories : null;
    //     $coupon->item_limit= $request->items ? $request->items :null;
    //     $coupon->country_limit= $request->countries ? $request->countries : null;
    //     $coupon->limit_per_user= $request->per_customer ? $request->per_customer : null;
    //     $coupon->status= $request->status ? true:false;
    //     $coupon->is_global = true;
    //     $coupon->save();
    // }

    public function destroy(Request $request){
        $coupons = Coupon::whereIn('id',$request->coupons)->delete();
        return redirect()->route('admin.coupons')->with(['result' => 1,'message' => 'Coupons Deleted Successfully']);
    }
   
}
