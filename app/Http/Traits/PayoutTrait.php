<?php
namespace App\Http\Traits;
use App\Models\Payout;
use App\Models\Setting;
use App\Http\Traits\PaystackTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\FlutterwaveTrait;

trait PayoutTrait
{
    use FlutterwaveTrait,PaystackTrait;

    protected function initializePayout(Payout $payout){
        $user = Auth::user();
        $gateway = $user->country->payment_gateway_receiving;
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

    public function verifybankaccount($account_number,$bank_code,$bvn=null,$branch=null){
        // $gateway = Setting::firstWhere('name','active_payment_gateway')->value;
        // switch($gateway){
        //     case 'paystack':  $result = $this->resolveBankAccountByPaystack($account_number,$bank_code,$bvn);
        //     break;
        //     case 'flutter': $result = $this->resolveBankAccountByFlutter($account_number,$bank_code,$bvn);
        //     break;
        // }
        // abandoning paystack bvn verification cos it doesn't return useful data
        $result = $this->resolveBankAccountByFlutter($account_number,$bank_code,$bvn);
        return $result;
    }
    
    

    
    

    

}