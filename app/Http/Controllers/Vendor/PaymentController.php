<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Shop;
use App\Models\Payout;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PayoutTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShopPayoutResource;
use App\Http\Resources\VendorPaymentResource;
use App\Http\Resources\ShopSettlementResource;

class PaymentController extends Controller
{
    use PayoutTrait,OrderTrait;

    public function __construct(){
        $this->middleware('auth:sanctum');
    }

    //vendor payments to us
    public function index(){
        $user = auth()->user();
        $notifications = DB::table('notifications')->whereNull('read_at')->where('notifiable_id',$user->id)->where('notifiable_type','App\Models\User')->whereJsonContains('data->related_to','payment')->update(['read_at'=> now()]);
        $payments = $user->payments->where('status','success')->sortByDesc('created_at')->take(100);
        return request()->expectsJson() ?  
        response()->json([
            'status' => true,
            'message' => $payments->count() ? 'Payments retrieved Successfully':'No Payment retrieved',
            'data' => VendorPaymentResource::collection($payments),
            'count' => $payments->count()
        ], 200) : view('vendor.payments',compact('payments'));
    }

    //shop earnings
    public function earnings(Shop $shop){
        $settlements = $shop->settlements->where('status',true);

        if(request()->query() && request()->query('start_date') && request()->query('end_date')){
            $start = request()->query('start_date');
            $end = request()->query('end_date');
            $settlements = $settlements->whereBetween('created_at',[$start,$end]);
        }else{
            $settlements = $settlements->whereBetween('created_at',[now(),now()->subMonth()]);
        }
        $settlements = $settlements->sortByDesc('created_at');
        return request()->expectsJson() ?  
        response()->json([
            'status' => true,
            'message' => $settlements->count() ? 'Earnings retrieved Successfully':'No earnings retrieved',
            'data' => ShopSettlementResource::collection($settlements),
            'count' => $settlements->count()
        ], 200) : view('vendor.shop.earnings',compact('shop','settlements'));
    }
    
    //all payouts
    public function payouts(Shop $shop){
        $notifications = DB::table('notifications')->whereNull('read_at')->where('notifiable_id',$shop->id)->where('notifiable_type','App\Models\Shop')->whereJsonContains('data->related_to','payout')->update(['read_at'=> now()]);
        
        $payouts = Payout::where('shop_id',$shop->id);

        if(request()->query() && request()->query('start_date') && request()->query('end_date')){
            $start = request()->query('start_date');
            $end = request()->query('end_date');
            $payouts = $payouts->whereBetween('created_at',[$start,$end]);
        }else{
            $payouts = $payouts->whereBetween('created_at',[now(),now()->subMonth()]);
        }
        $payouts = $payouts->orderBy('created_at','desc')->get();

        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => $payouts->count() ? 'Payouts retrieved Successfully':'No payout retrieved',
            'data' => ShopPayoutResource::collection($payouts),
            'count' => $payouts->count()
        ], 200) : view('vendor.shop.payouts',compact('shop','payouts'));
    }

    //request payout
    public function payout(Shop $shop,Request $request){
        $user = $shop->user;
        if($request->payout_id){
            Payout::where('id',$request->payout_id)->delete();
            return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Payout Cancel Successful',
            ], 200) : redirect()->back()->with(['result'=> '1','message'=> 'Payout Cancel Successful']);  
        }
        if($request->amount < $shop->user->minimum_payout() || $request->amount > $shop->user->maximum_payout()){
            return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Adjust payout to match minimum and maximum payout',
            ], 401) :  redirect()->back()->with(['result'=> '0','message'=> 'Adjust payout to match minimum and maximum payout']);
        }
        if($request->amount > $shop->wallet){
            return request()->expectsJson() ? 
            response()->json([
                'status' => true,
                'message' => 'Adjust payout to match minimum and maximum payout',
            ], 401) :  redirect()->back()->with(['result'=> '0','message'=> 'Insufficient Balance']);
        }
        
        $payout = Payout::create(['user_id'=> $user->id,'shop_id'=> $shop->id,'currency_id'=> $user->country->currency_id,
        'channel'=> $user->country->payout_gateway,
        'reference'=> uniqid(),'amount'=> $request->amount,'status'=> cache('settings')['auto_approve_payout'] ? 'approved':'pending']);
        $shop->wallet -= $request->amount;
        $shop->save();
        return request()->expectsJson() ? 
        response()->json([
            'status' => true,
            'message' => 'Payout Request Successful',
        ], 200) : redirect()->back()->with(['result'=> '1','message'=> 'Payout Request Successful']); 
    }


    public function payoutcallback(Request $request){
        
    }  


    public function apply(Request $request){
        $code = $request->code;
        $amount = $request->amount;
        return $this->getCoupon($code,$amount);
    }

    
}
