<?php
namespace App\Http\Traits;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Settlement;
use App\Models\PaymentItem;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PaypalTrait;
use App\Http\Traits\PaystackTrait;
use App\Http\Traits\FlutterwaveTrait;


trait PaymentTrait
{
    use PaystackTrait,FlutterwaveTrait,PaypalTrait,OrderTrait;

    protected function initializePayment($amount,$items,$type,$coupon){
        $user = auth()->user();
        $gateway = $user->country->payment_gateway;
        $coupon_id = null;
        $coupon_value = 0;
        if($coupon){
            $coupon_value = $this->getCoupon($coupon,$amount)['value'];
            $coupon_id = Coupon::where('code',$coupon)->first()->id;
        }
        $payment = Payment::create(['user_id'=> $user->id,'currency_id'=> $user->country->currency_id, 'reference'=> uniqid(),'coupon_id'=> $coupon_id,'coupon_value'=> $coupon_value,'amount'=> $amount ,'vat'=> $user->country->vat]);
        foreach($items as $item){
            PaymentItem::create(['payment_id'=> $payment->id,'paymentable_id'=> $item,'paymentable_type'=> $type]);
        }
        switch($gateway){
            case 'paystack': 
                $link = $this->initiatePaystack($payment);
                return ['link'=> $link,'reference'=> $payment->reference];
            break;
            case 'flutterwave': 
                $link = $this->initiateFlutterWave($payment);
                return ['link'=> $link,'reference'=> $payment->reference];
            break;
            case 'paypal': 
                $result = $this->initiatePaypal($payment);
                $payment->request_id = $payment->reference;
                $payment->reference = $result['reference'];
                $payment->save();
                return $result;
            break;
            case 'stripe': $link = $this->initiateStripe($payment);
                return true;
            break;
            default: return false;
        }
        
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
            case 'flutterwave': 
                $details = $this->verifyFlutterWavePayment($payment->reference);
                $payment->request_id = $details->data->id;
                $payment->save();
                return ['status'=> $details->status == 'success'? true:false,'trx_status'=> $details->data ->status == 'successful' ? 'success':'failed','amount'=> $details->data->amount,'method'=> $details->data->payment_type];
            break;
            case 'paypal': 
                $details =  $this->verifyPaypalPayment($payment->reference,$payment->request_id);
                $payment->reference = $details->purchase_units[0]->payments->captures[0]->id;
                $payment->save();
                return ['status'=> $details->status == 'COMPLETED'? true:false,'trx_status'=> $details->purchase_units[0]->payments->captures[0]->final_capture ? 'success':'failed','amount'=> $details->purchase_units[0]->payments->captures[0]->amount->value,'method'=> 'paypal'];
            break;
            case 'stripe': $details =  $this->verifyStripePayment($payment->reference);
            break;
        }
    }


    
    

}