<?php
namespace App\Http\Traits;
use App\Models\Payout;
use App\Models\Payment;
use App\Models\PaymentItem;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;


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
      if($response && $response->status)
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

    public function payoutPaystack(Payout $payout){
        $user = auth()->user();
        $currency = session('locale')['currency_iso'];
        $response = Curl::to('https://api.paystack.co/transaction/initialize')
        ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
        ->withHeader('Content-Type: application/json')
        ->withData( array('email'=> $user->email,'amount'=> $payout->amount,'currency'=> $currency,
                        'reference'=> $payout->reference,"callback_url"=> route('payment.callback'),
                        'metadata' => json_encode(['user_id'=> $user->id,'phonenumber'=> $user->phone])
                        ) )
        
        ->asJson()                
        ->post();
        if($response->status)
          return $response->data->authorization_url;
        else return false;
    }
    
    

    protected function retryPaystack(Payout $payout){
        $response = Curl::to("https://api.paystack.com/v3/transfers/$payout->transfer_id/retries")
            ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
            ->asJson()
            ->get();
        //check the status and update
    }

    
    
    // protected function resolveBankAccountByPaystack($account_number,$bank,$bvn){

    //     // $response = Curl::to('https://api.paystack.co/bvn/match')
    //     //         ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
    //     //         ->withHeader('Content-Type: application/json')
    //     //         ->withData( array('bvn'=> $bvn,"account_number" => $account_number,"bank_code" => $bank) )
    //     //         ->asJson()
    //     //         ->post();
    //     //     return $response;  
    //     // dd($response);

    //     // $response = Curl::to('https://api.paystack.co/bank/resolve')
    //     //         ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
    //     //         ->withHeader('Content-Type: application/json')
    //     //         ->withData( array('account_number'=> $account_number,"bank_code" => $bank) )
    //     //         ->get();
    //     // if($response )
    //     // //     return $response;  
    // }

    protected function getBanksByPaystack(){
        
    }


}