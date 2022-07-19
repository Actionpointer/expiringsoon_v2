<?php
namespace App\Http\Traits;
use App\Models\Setting;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;


trait FlutterWaveTrait
{
    // protected function resolveBankAccount($account_bank,$account_number){
    //     $response = Curl::to('https://api.flutterwave.com/v3/accounts/resolve')
    //     ->withHeader('Authorization: Bearer '.config('services.flutter_test_secret_key'))
    //     ->withData( array('account_number'=> '0051911523',"account_bank" => '058') )
    //     ->asJson()
    //     ->post();
    //     return $response;  
    // }

    protected function initializePayment($amount){
        $user = Auth::user();
        $currency = Setting::where('name','currency')->first()->value;
        $response = Curl::to('https://api.flutterwave.com/v3/payments')
        ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
        ->withData( array('customer' => ['email'=> $user->email,'phonenumber'=> $user->phone,'name'=> $user->fname.' '.$user->lname],
                        'tx_ref'=> uniqid(),"currency" => $currency,"payment_options"=>"card,account,ussd",
                        "redirect_url"=> route('payment.verification'),'amount'=> $amount,
                        'metadata' => ['user_id'=> $user->id],
                        "customizations"=> [
                            "title"=>"Expiring Soon",
                            "description"=>"Wallet Topup",
                            "logo"=> asset('src/images/logo.png')
                        ]) )
        ->asJson()
        ->post();
        return $response;
    }
    

    protected function verifyPayment($value){
        $paymentDetails = Curl::to('https://api.flutterwave.com/v3/transactions/'.$value.'/verify/')
         ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
         ->asJson()
         ->get();
        return $paymentDetails;
    }
    // {
    //     "status": true,
    //     "message": "Verification successful",
    //     "data": {
    //       "amount": 27000,
    //       "currency": "NGN",
    //       "transaction_date": "2016-10-01T11:03:09.000Z",
    //       "status": "success",
    //       "reference": "DG4uishudoq90LD",
    //       "domain": "test",
    //       "metadata": 0,
    //       "gateway_response": "Successful",
    //       "message": null,
    //       "channel": "card",
    //       "ip_address": "41.1.25.1",
    //       "log": {
    //         "time_spent": 9,
    //         "attempts": 1,
    //         "authentication": null,
    //         "errors": 0,
    //         "success": true,
    //         "mobile": false,
    //         "input": [],
    //         "channel": null,
    //         "history": [{
    //           "type": "input",
    //           "message": "Filled these fields: card number, card expiry, card cvv",
    //           "time": 7
    //           },
    //           {
    //             "type": "action",
    //             "message": "Attempted to pay",
    //             "time": 7
    //           },
    //           {
    //             "type": "success",
    //             "message": "Successfully paid",
    //             "time": 8
    //           },
    //           {
    //             "type": "close",
    //             "message": "Page closed",
    //             "time": 9
    //           }
    //         ]
    //       }
    //       "fees": null,
    //       "authorization": {
    //         "authorization_code": "AUTH_8dfhjjdt",
    //         "card_type": "visa",
    //         "last4": "1381",
    //         "exp_month": "08",
    //         "exp_year": "2018",
    //         "bin": "412345",
    //         "bank": "TEST BANK",
    //         "channel": "card",
    //         "signature": "SIG_idyuhgd87dUYSHO92D",
    //         "reusable": true,
    //         "country_code": "NG",
    //         "account_name": "BoJack Horseman"
    //       },
    //       "customer": {
    //         "id": 84312,
    //         "customer_code": "CUS_hdhye17yj8qd2tx",
    //         "first_name": "BoJack",
    //         "last_name": "Horseman",
    //         "email": "bojack@horseman.com"
    //       },
    //       "plan": "PLN_0as2m9n02cl0kp6",
    //       "requested_amount": 1500000
    //     }
    //   }
}