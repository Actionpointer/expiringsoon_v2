<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Bank;
use App\Models\Shop;
use App\Models\Payout;
use App\Models\Account;
use App\Models\Settlement;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use Illuminate\Validation\Rule;
use App\Http\Traits\PayoutTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
        $settlements = $shop->settlements->sortByDesc('created_at')->take(100);
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
        $payouts = $shop->payouts->sortByDesc('created_at')->take(100);
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
        'reference'=> uniqid(),'amount'=> $request->amount]);
        $shop->wallet -= $request->amount;
        $shop->save();
        if(cache('settings')['automatic_payout_transfer']){
            $this->initializePayout($payout);
        }
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
