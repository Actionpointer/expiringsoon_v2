<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Feature;
use App\Models\Payment;
use App\Models\Settlement;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use App\Http\Traits\PaymentTrait;
use App\Models\OrderStatus;

class PaymentController extends Controller
{
    use PaymentTrait;
    public function __construct(){
        // $this->middleware('auth');
    }

    public function paymentcallback(){
        // dd(request()->query);
        // ["trxref" => "632889cbaa15f","reference" => "632889cbaa15f"]
        //check status of transaction ..if failed, 
        //flutterwave = request()->query('status') // successful, cancelled
        //paystack = request()->query('status') // 
        
        $user = auth()->user();
        $gateway = $user->country->payment_gateway;
        if($gateway == 'flutterwave' && request()->query('status') != 'successful'){
            //delete this order, and remove the order number from the cart
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again1']);
        }
        if($gateway == 'paystack'){
            $details = $this->verifyPaystackPayment(request()->query('reference'));
        }  
        if($gateway == 'flutterwave'){
            $details = $this->verifyFlutterWavePayment(request()->query('tx_ref'));
        }
        if($gateway == 'paypal'){
            // $details = $this->verifyPaystackPayment(request()->query('reference'));
        }  
        if($gateway == 'stripe'){
            // $details = $this->verifyFlutterWavePayment(request()->query('tx_ref'));
        }
        
        if(!$this->getPaymentData('status',$details)){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again2']);
        }
        if(!$this->getPaymentData('trx_status',$details)){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again3']);
        }
        if(!$payment = Payment::where('reference',$this->getPaymentData('reference',$details))->first()){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again4']);
        }
        if($payment->amount != $this->getPaymentData('amount',$details)){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again5']);
        }
        $payment->status = 'success';
        $payment->save();
        $this->giveValueAfterPayment($payment);
        return redirect()->route('home')->with(['result'=>1,'message'=> 'Payment Successful']);
       
    }

    public function status(Payment $payment){
        $user = auth()->user();
        $gateway = $user->country->payment_gateway;
        if($gateway == 'paystack'){
            $details = $this->verifyPaystackPayment($payment->reference);
        }  
        else {
            $details = $this->verifyFlutterWavePayment($payment->reference);
        }
        // dd($this->getPaymentData('method',$details));
        if(!$this->getPaymentData('status',$details)){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
        }
        if(!$this->getPaymentData('trx_status',$details)){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
        }
        $payment = Payment::where('reference',$this->getPaymentData('reference',$details))->first();
        if(!$payment){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payment was not successful. Please try again']);
        }
        if($payment->amount != $this->getPaymentData('amount',$details)){
            return redirect('home')->with('statuss','Payment was not successful. Please try again');
        }
        $payment->status = 'success';
        $payment->method = $this->getPaymentData('method',$details);
        $payment->save();
        $this->giveValueAfterPayment($payment);
        return redirect()->route('home')->with(['result'=> 1,'message'=> 'Payment Successful']);
    }

    public function giveValueAfterPayment(Payment $payment){
        if($payment->status){
            foreach($payment->items as $item){
                if($item->paymentable_type == 'App\Models\Order'){
                    $order = Order::find($item->paymentable_id);
                    // OrderStatus::create(['order_id'=> $item->paymentable_id,'user_id'=> $payment->user_id,'name'=> 'processing']);
                    $status = $order->statuses()->create(['user_id'=> $payment->user_id,'name'=> 'processing']);
                }
                if($item->paymentable_type == 'App\Models\Feature'){
                    $feature = Feature::find($item->paymentable_id);
                    $feature->status = true;
                    $feature->save();
                }
                if($item->paymentable_type == 'App\Models\Subscription'){
                    $subscription = Subscription::find($item->paymentable_id);
                    $duration = $subscription->end_at->diffInMonths($subscription->start_at);
                    $renew_at = null;
                    switch($duration){
                        case '1': $renew_at =  now()->addMonths($duration)->subWeeks(1);
                        break;
                        case '3': $renew_at = now()->addMonths($duration)->subWeeks(2);
                        break;
                        case '6': $renew_at = now()->addMonths($duration)->subWeeks(3);
                        break;
                        case '12': $renew_at = now()->addMonths($duration)->subWeeks(4);
                        break;
                    }
                    $subscription->status = true;
                    $subscription->start_at = now();
                    $subscription->renew_at = $renew_at;
                    $subscription->end_at = now()->addMonths($duration);
                    $subscription->save();
                    $subscription->user->subscription_id = $subscription->id;
                    $subscription->user->save();
                }
            }
        }
        
    }

    public function invoice(Payment $payment){
        return view('invoice',compact('payment'));
    }
    
    public function receipt(Settlement $settlement){
        return view('receipt',compact('settlement'));
    }

    public function verification(){
        if(!request()->query() || !request()->query('transaction_id') || !request()->query('tx_ref'))
        \abort(404);
        $trans_id = request()->query('transaction_id');
        $trans_ref = request()->query('tx_ref');
        $trans_status = request()->query('status');
        $response = $this->verifyPayment($trans_id);
        // dd($response);
        $payment = Payment::where('reference',$trans_ref)->first();
        if($trans_status == 'successful' && $response->status == 'success' && $payment && $response && $payment->reference == $response->data->tx_ref  && $response->data->currency == $payment->currency && $response->data->amount >= $payment->amount){
            $payment->method = $response->data->payment_type;
            $payment->status = 'success';
            $payment->save();
        }else{
            $payment->status = 'failed';
            $payment->save();
        }
        // else mark payment failed
        return redirect()->route('payment.status',$payment);
    }

    

    // public function topup(Request $request){
    //     if($url = $this->initializePayment($request->amount)){
    //         return redirect()->to($url);
    //     }else
    //         return redirect()->back()->with(['result'=> '0','message'=> 'Error Processing Payment']);
    // }

    
    
    
    
    


    
}
