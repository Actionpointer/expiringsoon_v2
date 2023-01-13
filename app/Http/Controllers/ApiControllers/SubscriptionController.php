<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    use PaymentTrait,OrderTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //my subscription
        $user = auth()->user();
        if($user->activeSubscription){
            return response()->json([
                'status' => true,
                'message' => 'Subscription Retrived Successfully',
                'data' => $user->activeSubscription
            ], 200);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Subscription Retrived Successfully',
                'data' => Plan::where('slug','free_plan')->first()
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        if(!$link){
            return response()->json([
                'status' => false,
                'message' => 'service unavailable right now..TRY AGAIN LATER',
                'data' => null
            ], 200);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => 'open link on your browser',
                'data' => $link
            ], 200);
        }
    }


    public function subscription_cancel_renew(Request $request){
        $subscription = Subscription::find($request->subscription_id);
        $subscription->auto_renew = false;
        $subscription->save();
        return redirect()->back();
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
