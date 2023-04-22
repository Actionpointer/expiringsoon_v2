<?php
namespace App\Http\Traits;

use App\Models\Payout;
use App\Models\Payment;
use App\Models\Settlement;
use Ixudra\Curl\Facades\Curl;


trait PaypalTrait
{

    protected function get_token(){
        $client = base64_encode(config('services.paypal.client'));
        $secret = base64_encode(config('services.paypal.secret'));
        $response = Curl::to('https://api-m.sandbox.paypal.com/v1/oauth2/token')
            ->withHeader("Authorization: Basic ".$client.":".$secret)
            ->withHeader('Content-Type: application/x-www-form-urlencoded')
            ->withData(["grant_type"=>"client_credentials"])
            ->asJsonResponse()
            ->post();
        if($response && $response->access_token){
            cache(['paypal_token' => $response->access_token]);
            return true;
        }
        return false;
    }

    protected function initiatePaypal(Payment $payment){
        $user = auth()->user();
        $token = true;
        for($i = 2;$i > 0;$i--){
            $response = Curl::to("https://api-m.sandbox.paypal.com/v2/checkout/orders")
            ->withHeader('Authorization: Bearer '.cache('paypal_token'))
            ->withHeader('PayPal-Request-Id: '.$payment->reference)
            ->withData([
                "intent" => "CAPTURE",
                "purchase_units" => [
                    [
                        "items" => [
                            [
                                "name" => "Payment on Expiringsoon",
                                "description" => "Payment for ".($user->role->name == 'shopper' ? 'Orders':'Subscription/Adverts'),
                                "quantity" => "1",
                                "unit_amount" => [
                                    "currency_code" => $payment->currency->iso,
                                    "value" => $payment->amount,
                                ],
                            ],
                        ],
                        "amount" => [
                            "currency_code" => $payment->currency->iso,
                            "value" => $payment->amount,
                            "breakdown" => [
                                "item_total" => [
                                    "currency_code" => $payment->currency->iso,
                                    "value" => $payment->amount,
                                ],
                            ],
                        ],
                    ],
                ],
                "application_context" => [
                    "return_url" => route('payment.callback').'?status=success&reference='.$payment->reference,
                    "cancel_url" => route('home').'?status=cancelled&reference='.$payment->reference,
                ],
            ])
            ->asJson()
            ->post();
            // dd($response);
            if($response && $response->status == 'CREATED' && $response->links[1]->href){
                $link = $response->links[1]->href;
                $ref = $response->id;
                break;
            }
            if($response && $response->error && $response->error == 'invalid_token'){
                $token = $this->get_token();
            }
        }
        if(isset($link) && isset($ref)){
            return ['link'=> $link,'reference'=> $ref];
        }elseif(!$token){
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Something went wrong']);
        } 
      
    }  

    protected function verifyPaypalPayment($reference,$request_id){
        $paymentDetails = Curl::to("https://api-m.sandbox.paypal.com/v2/checkout/orders/$reference/capture")
            ->withHeader('Content-Type: application/json')
            ->withHeader('Authorization: Bearer '.cache('paypal_token'))
            ->withHeader('PayPal-Request-Id: '.$request_id)
            ->asJsonResponse()
            ->post();
        //  dd($paymentDetails);
        return $paymentDetails;
    }

    protected function refundPaypal(Settlement $settlement){
        $payment = $settlement->order->payment_item->payment;
        $payment->request_id = uniqid();
        $payment->save();
        $reference = $payment->reference;
        $response = Curl::to("https://api-m.sandbox.paypal.com/v2/payments/captures/$reference/refund")
            ->withHeader('Content-Type: application/json')
            ->withHeader('Authorization: Bearer '.cache('paypal_token'))
            ->withHeader('PayPal-Request-Id: '.$payment->request_id)
            ->withData( array('transaction'=> $settlement->order->payment_item->payment->reference,'amount'=> $settlement->amount ) )
            ->withData([
                    "amount"=> [ "value"=> $settlement->amount, "currency_code"=> $settlement->order->payment_item->payment->currency->iso],
                    "invoice_id"=> $settlement->order->id,
                    "note_to_payer"=> "Order Cancelled"
            ])
            ->asJson()
            ->post();
        if($response &&  isset($response->status) && $response->status == 'COMPLETED')
        return true;
        else return false;
    }
    

    protected function payoutPaypal(Payout $payout){
        $response = Curl::to('https://api.paystack.co/transfer')
        ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
        ->withHeader('Content-Type: application/json')
        ->withData( array("source" => "balance", "reason"=> "Withdrawal Payout", "amount"=> $payout->amount * 100, "recipient"=> $payout->user->payout_account,
        "currency"=> $payout->currency->iso,"reference"=> $payout->reference ) )
        ->asJson()                
        ->post();
        dd($response);
        if($response &&  isset($response->status) && $response->status)
          return true;
        else return false;
    }

    protected function verifyPayoutPaypal(Payout $payout){
      $response = Curl::to("https://api.paystack.co/transfer/verify/$payout->reference")
          ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
          ->asJson()
          ->get();
      //check the status and update
  }
    
    

    protected function retryPaypal(Payout $payout){
        $response = Curl::to("https://api.paystack.com/v3/transfers/$payout->transfer_id/retries")
            ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
            ->asJson()
            ->get();
        //check the status and update
    }


}