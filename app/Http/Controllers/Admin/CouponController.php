<?php

namespace App\Http\Controllers\Admin;


use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Controllers\Controller;


class CouponController extends Controller
{
    use OrderTrait;

    public function list(){
        $coupons = Coupon::within()->paginate(10);
        $countries = Country::all();
        return view('admin.coupons',compact('coupons','countries'));
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
