<?php
namespace App\Http\Traits;

use App\Models\Payout;
use App\Models\Payment;
use App\Models\Settlement;
use Ixudra\Curl\Facades\Curl;


trait PaystackTrait
{

    public function initiatePaystack(Payment $payment){
      $response = Curl::to('https://api.paystack.co/transaction/initialize')
      ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
      ->withHeader('Content-Type: application/json')
      ->withData( array('email'=> $payment->user->email,'amount'=> $payment->amount*100,'currency'=> session('locale')['currency_iso'],
                      'reference'=> $payment->reference,"callback_url"=> route('payment.callback') ) )
      ->asJson()                
      ->post();
      if($response &&  isset($response->status) && $response->status)
        return $response->data->authorization_url;
      else return false;
    }

    protected function verifyPaystackPayment($value){
        $paymentDetails = Curl::to('https://api.paystack.co/transaction/verify/'.$value)
         ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
         ->asJson()
         ->get();
        return $paymentDetails;
    }

    protected function refundPaystack(Settlement $settlement){
        $response = Curl::to('https://api.paystack.co/refund')
         ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
         ->withData( array('transaction'=> $settlement->order->payment_item->payment->reference,'amount'=> $settlement->amount*100 ) )
         ->asJson()
         ->post();
         if($response &&  isset($response->status) && $response->status)
         return true;
       else return false;
    }

    protected function createRecipient($bank_code,$account_number){
      $user = auth()->user();
      $type = '';
      $currency = '';
      switch($user->country->iso){
        case 'NG': 
          $type = 'nuban'; 
          $currency = $user->country->currency->iso;
        break;
        case 'GH': $type = 'mobile_money'; $currency = $user->country->currency->iso;
        break;
        case 'ZAR': $type = 'basa'; $currency = $user->country->currency->iso;
        break;
      }
      $response = Curl::to('https://api.paystack.co/transferrecipient')
        ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
        ->withHeader('Content-Type: application/json')
        ->withData( array('type'=> $type,'account_number'=> $account_number,'currency'=> $currency,
                        'bank_code'=> $bank_code ) )
        
        ->asJson()                
        ->post();
      if($response && isset($response->status) && $response->status)
        return $response->data->recipient_code; 
      else return false;
    }


    public function payoutPaystack(Payout $payout){
        $response = Curl::to('https://api.paystack.co/transfer')
        ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
        ->withHeader('Content-Type: application/json')
        ->withData( array("source" => "balance", "reason"=> "Withdrawal Payout", "amount"=> $payout->amount * 100, "recipient"=> $payout->user->payout_account,
        "currency"=> $payout->currency->code,"reference"=> $payout->reference ) )
        ->asJson()                
        ->post();
        // dd($response);
        if($response &&  isset($response->status) && $response->status)
          return true;
        else return false;
    }

    protected function verifyPayoutPaystack(Payout $payout){
      $response = Curl::to("https://api.paystack.co/transfer/verify/$payout->reference")
          ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
          ->asJson()
          ->get();
      //check the status and update
    }
    
    

    protected function retryPaystack(Payout $payout){
        $response = Curl::to("https://api.paystack.com/v3/transfers/$payout->transfer_id/retries")
            ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
            ->asJson()
            ->get();
        //check the status and update
    }

    
    
    protected function resolveBankAccountByPaystack($bank_code,$account_number){

        $response = Curl::to('https://api.paystack.co/bank/resolve')
              ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
              ->withHeader('Content-Type: application/json')
              ->withData( array('account_number'=> $account_number,"bank_code" => $bank_code) )
              ->asJsonResponse()
              ->get();
        if(!$response || !$response->status){
          return false;
        }
        return $response->data->account_name;
    }

    protected function getBanksByPaystack(){
        
    }


}