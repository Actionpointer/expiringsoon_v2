<?php
namespace App\Http\Traits;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Purchase;
use App\Models\Settlement;
use App\Models\PaymentItem;
use Illuminate\Support\Str;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\PaypalTrait;
use App\Http\Traits\PaystackTrait;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\FlutterwaveTrait;


trait PaymentTrait
{
    use PaystackTrait,FlutterwaveTrait,PaypalTrait,OrderTrait;

    public function getRedirectionRoute(Purchase $purchase){
        $store = $purchase->store;
        switch($purchase->purchaseable_type){
            case 'App\Models\Subscription': return route('store.settings.subscription',$store);
                break;
            case 'App\Models\Deposit': return route('orders');
                break;
            case 'App\Models\Advert': return route('store.marketing.adverts',$store);
                break;
            case 'App\Models\Newsletter': return route('store.marketing.newsletters',$store);
                break;
            default: return route('store.dashboard',$store);
        }
    }

    // public function getCustomerRedirectionRoute(){
    //     return route('orders');
    // }

    public function giveValueAfterPayment(Payment $payment){
        $route = null;
        switch($payment->paymentable_type){
            case 'App\Models\Purchase':
                    $payment->paymentable->completed_at = now();
                    $payment->paymentable->save();
                    foreach($payment->paymentable->items as $item){
                        
                        if($item->purchaseable_type == 'App\Models\Subscription'){
                            $item->purchaseable->status = true;
                            $item->purchaseable->save();
                        }
                        if($item->purchaseable_type == 'App\Models\Deposit'){
                            $item->purchaseable->status = true;
                            $item->purchaseable->save();
                            //credit the wallet
                        }
                    }
                    
                    $route = $this->getRedirectionRoute($payment->paymentable);

                break;
            case 'App\Models\Order': $route = route('orders');
                break;
            default: $route = route('welcome');
        }
        return $route;
    }

    public function getGateway(Payment $payment){
        $gateway = $payment->paymentable_type == 'App\Models\Purchase'? 
        $payment->paymentable->store->country->active_gateway()->gateway : 
        $payment->paymentable->user->country->active_gateway()->gateway;
        return $gateway->slug;
    }

    public function initializePayment(Payment $payment){
        $gateway = $this->getGateway($payment);
        
        switch($gateway){
            case 'paystack': 
                $link = $this->initiatePaystack($payment);
                return ['redirect_url'=> $link];
            break;
            case 'flutterwave': 
                $link = $this->initiateFlutterWave($payment);
                return ['redirect_url'=> $link,'reference'=> $payment->reference];
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
        $gateway = $this->getGateway($payment);
        switch($gateway){
            case 'paystack': 
                $details = $this->verifyPaystackPayment($payment->reference);
                return ['status'=> $details->status,
                        'trx_status'=> $details->data->status,
                        'amount'=> $details->data->amount/100,
                        'method'=> $details->data->channel];
            break;
            case 'flutterwave': 
                $details = $this->verifyFlutterWavePayment($payment->reference);
                $payment->request_id = $details->data->id;
                $payment->save();
                return ['status'=> $details->status == 'success'? true:false,
                        'trx_status'=> $details->data->status == 'successful' ? 'success':'failed',
                        'amount'=> $details->data->amount,
                        'method'=> $details->data->payment_type];
            break;
            case 'paypal': 
                $details =  $this->verifyPaypalPayment($payment->reference,$payment->request_id);
                $payment->reference = $details->purchase_units[0]->payments->captures[0]->id;
                $payment->save();
                return ['status'=> $details->status == 'COMPLETED'? true:false,
                        'trx_status'=> $details->purchase_units[0]->payments->captures[0]->final_capture ? 'success':'failed',
                        'amount'=> $details->purchase_units[0]->payments->captures[0]->amount->value,
                        'method'=> 'paypal'];
            break;
            case 'stripe': $details =  $this->verifyStripePayment($payment->reference);
            break;
        }
    }


    
    

}