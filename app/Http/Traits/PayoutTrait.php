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
            case 'paystack': $this->payoutPaystack($payout);
            break;
            case 'flutterwave': $this->payoutFlutterWave($payout);
            break;
            case 'paypal': $this->payoutPaypal($payout);
            break;
            case 'stripe': $this->payoutStripe($payout);
            break;
        }
    }

    protected function verifyPayout(Payout $payout){
        $gateway = $payout->user->country->payout_gateway;
        switch($gateway){
            case 'paystack': $this->verifyPayoutPaystack($payout);
            break;
            case 'flutterwave': $this->verifyPayoutFlutterwave($payout);
            break;
            case 'paypal': $this->verifyPayoutPaypal($payout);
            break;
            case 'stripe': $this->verifyPayoutStripe($payout);
            break;
        }
        //save to paid/failed
        
    }

    protected function retryPayout(Payout $payout){
        $user = $payout->user;
        $gateway = $user->country->payout_gateway;
        switch($gateway){
            case 'paystack': $this->retryPayoutPaystack($payout);
            break;
            case 'flutterwave': $this->retryPayoutFlutterWave($payout);
            break;
            case 'paypal': $this->retryPayoutPaypal($payout);
            break;
            case 'stripe': $this->retryPayoutStripe($payout);
            break;
        }
        //save to paid/failed
    }

    public function listBanks($gateway,$country){
        switch($gateway){
            case 'paystack': 
                //ghana,kenya,nigeria,south africa
                return $this->banksByPaystack($country);
            break;
            case 'flutterwave': 
                return $this->banksByFlutter($country);
            break;
            case 'paypal': 
                return $this->banksByPaypal($country);
            break;
            case 'stripe':
                return $this->banksByStripe($country);
            break;
            default: return false;
        }

    }

    public function verifyBankAccount($gateway,$bank_code, $account_number,$account_name){
        switch($gateway){
            case 'paystack': 
                $gateway_account_name = $this->resolveBankAccountByPaystack($bank_code, $account_number);
                if ($gateway_account_name && str_contains(strtolower($gateway_account_name), strtolower($account_name))) {
                    return true;
                }
                break;
            case 'flutterwave': 
                $gateway_account_name = $this->resolveBankAccountByFlutter($bank_code, $account_number);
                if ($gateway_account_name && str_contains(strtolower($gateway_account_name), strtolower($account_name))) {
                    return true;
                }
                break;
        }
        return false;
    }
    
    

    
    

    

}