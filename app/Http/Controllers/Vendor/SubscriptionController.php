<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Plan;
use App\Models\Price;
use App\Models\Adplan;
use App\Models\Feature;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;

class SubscriptionController extends Controller
{
    use PaymentTrait,OrderTrait;

    public function __construct(){
        $this->middleware('auth:sanctum')->except('plans');
    }

    public function plans(){
        $plans = Plan::orderBy('id','desc')->get();
        $enterprises = $plans->keyBy('slug');
        return request()->expectsJson()
        ? response()->json(['status' => true, 'message' => 'Plans retrieved Successfully','data' => PlanResource::collection($plans)], 200)
        : view('plans',compact('plans','enterprises'));
    }
    
    public function subscribe(Request $request){
        try{
            $user = auth()->user();
            if($request->has('subscription_id')){
                $subscription = Subscription::find($request->subscription_id);
                if($user->subscription_id && $user->subscription_id == $subscription->id && $user->subscription->renew_at && $user->subscription->renew_at > now()){
                    return redirect()->back()->with(['result'=> 0,'message'=> 'Subscription already exist']);
                }
            }
            if($request->has('plan')){
                $plan = Plan::where('slug',$request->plan)->first();
                if($user->subscription_id && $user->subscription->plan_id == $plan->id && $user->subscription->renew_at && $user->subscription->renew_at > now()){
                    return redirect()->back()->with(['result'=> 0,'message'=> 'Subscription already exist']);
                }
                $subscription = Subscription::create(
                    ['user_id'=> auth()->id(),
                    'plan_id'=> $plan->id,
                    'amount'=> $request->coupon_used ? $plan['months_'.$request->duration] - $this->getCoupon($request->coupon_used,$plan['months_'.$request->duration])['value'] : $plan['months_'.$request->duration],
                    'start_at'=> now(),
                    'renew_at'=> $this->renewal_period($request->duration),
                    'end_at'=> now()->addMonths($request->duration),
                    'coupon' => $request->coupon_used,
                    'auto_renew'=> $request->auto_renew ? true:false
                ]);
            
            }
            $link = $this->initializePayment($subscription->amount,[$subscription->id],'App\Models\Subscription');
            return request()->expectsJson()
            ? response()->json(['status' => true, 'message' => 'Subscription Payment Required. Open link in browser','data' => $link], 200)
            : redirect()->to($link);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        
    }    

    public function cancel_renewal(Request $request){
        $subscription = Subscription::find($request->subscription_id);
        $subscription->auto_renew = false;
        $subscription->save();
        return request()->expectsJson()
            ? response()->json(['status' => true, 'message' => 'Subscription Renewal Cancelled'], 200)
            : redirect()->back()->with(['result'=> 1,'message'=> 'Subscription Renewal Cancelled']);
        
    }

    public function renewal_period($duration){
        switch($duration){
            case '1': return now()->addMonths($duration)->subWeeks(1);
            break;
            case '3': return now()->addMonths($duration)->subWeeks(2);
            break;
            case '6': return now()->addMonths($duration)->subWeeks(3);
            break;
            case '12': return now()->addMonths($duration)->subWeeks(4);
            break;
        }
    }
      
}
