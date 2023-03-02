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
        return $link;
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


    protected function getPaymentData($option,$value){
        $user = auth()->user();
        $gateway = $user->country->payment_gateway;
        switch($option){
            case 'status': return in_array($value->status,['success',true]); 
                break;
            case 'trx_status': return in_array($value->data->status,['success','successful']);
                break;
            case 'amount': return $gateway == 'paystack' ? $value->data->amount/100 : $value->data->amount;
                break;
            case 'reference': return $gateway == 'paystack' ? $value->data->reference : $value->data->tx_ref;
                break;
            case 'method': return $gateway == 'paystack' ? $value->data->channel : $value->data->payment_type;
                break;
        }  
    }
    

}