<?php
namespace App\Http\Traits;

use App\Models\Payout;
use App\Http\Traits\PaypalTrait;
use App\Http\Traits\PaystackTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\FlutterwaveTrait;

trait PayoutTrait
{
    use FlutterwaveTrait,PaystackTrait,PaypalTrait;

    protected function initializePayout(Payout $payout){
        $user = $payout->user;
        $gateway = $user->country->payout_gateway;
        switch($gateway){
            case 'paystack': $link = $this->payoutPaystack($payout);
            break;
            case 'flutterwave': $link = $this->payoutFlutterWave($payout);
            break;
            case 'paypal': $link = $this->payoutPaypal($payout);
            break;
            case 'stripe': $link = $this->payoutStripe($payout);
            break;
        }
        return $link;
    }

    protected function verifyPayout(Payout $payout){
        $gateway = $payout->user->country->payout_gateway;
        switch($gateway){
            case 'paystack': $details = $this->verifyPayoutPaystack($payout);
            break;
            case 'flutterwave': $details = $this->verifyPayoutFlutterwave($payout);
            break;
            case 'paypal': $details = $this->verifyPayoutPaypal($payout);
            break;
            case 'stripe': $details = $this->verifyPayoutStripe($payout);
            break;
        }
        
    }

    protected function retryPayout(Payout $payout){
        $user = $payout->user;
        $gateway = $user->country->payout_gateway;
        switch($gateway){
            case 'paystack': $link = $this->retryPayoutPaystack($payout);
            break;
            case 'flutterwave': $link = $this->retryPayoutFlutterWave($payout);
            break;
            case 'paypal': $link = $this->retryPayoutPaypal($payout);
            break;
            case 'stripe': $link = $this->retryPayoutStripe($payout);
            break;
        }
        return $link;
    }

    public function verifybankaccount($bank_code,$account_number){
        $user = Auth::user();
        $gateway = $user->country->payout_gateway;
        switch($gateway){
            case 'paystack':  $result = $this->resolveBankAccountByPaystack($bank_code,$account_number);
            break;
            case 'flutterwave': $result = $this->resolveBankAccountByFlutter($bank_code,$account_number);
            break;
        }
        return $result;
    }
    
    

    
    

    

}