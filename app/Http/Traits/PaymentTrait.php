<?php
namespace App\Http\Traits;
use App\Models\Payment;
use App\Models\Settlement;
use App\Models\PaymentItem;
use App\Http\Traits\PaypalTrait;
use App\Http\Traits\PaystackTrait;
use App\Http\Traits\FlutterwaveTrait;


trait PaymentTrait
{
    use FlutterwaveTrait,PaystackTrait,PaypalTrait;

    protected function initializePayment($amount,$items,$type){
        $user = auth()->user();
        $gateway = $user->country->payment_gateway;
        $payment = Payment::create(['user_id'=> $user->id,'currency_id'=> $user->country->currency_id,'reference'=> uniqid(),'amount'=> $amount ,'vat'=> $user->country->vat]);
        foreach($items as $item){
            PaymentItem::create(['payment_id'=> $payment->id,'paymentable_id'=> $item,'paymentable_type'=> $type]);
        }
        switch($gateway){
            case 'paystack': $link = $this->initiatePaystack($payment);
            break;
            case 'flutterwave': $link = $this->initiateFlutterWave($payment);
            break;
            case 'paypal': $link = $this->initiatePaypal($payment);
            break;
            case 'stripe': $link = $this->initiateStripe($payment);
            break;
        }
        return ['link'=> $link,'reference'=> $payment->reference];
    }

    protected function initializeRefund(Settlement $settlement){
        
        $gateway = $settlement->receiver->country->payment_gateway;
        switch($gateway){
            case 'paystack': return $this->refundPaystack($settlement);
            break;
            case 'flutterwave': return $this->refundFlutterWave($settlement);
            break;
            case 'paypal': return $this->refundPaypal($settlement);
            break;
            case 'stripe': return $this->refundStripe($settlement);
            break;
        }
    }

    protected function verifyPayment(Payment $payment){
        $gateway = $payment->user->country->payment_gateway;
        switch($gateway){
            case 'paystack': 
                $details = $this->verifyPaystackPayment($payment->reference);
                return ['status'=> $details->status,'trx_status'=> $details->data->status,'amount'=> $details->data->amount/100,'method'=> $details->data->channel];
            break;
            case 'flutterwave': $details = $this->verifyFlutterWavePayment($payment->reference);
                return ['status'=> $details->status == 'success'? true:false,'trx_status'=> $details->data ->status == 'successful' ? 'success':'failed','amount'=> $details->data->amount,'method'=> $details->data->payment_type];
            break;
            case 'paypal': $details =  $this->verifyPaypalPayment($payment->reference);
            break;
            case 'stripe': $details =  $this->verifyStripePayment($payment->reference);
            break;
        }
    }


    
    

}