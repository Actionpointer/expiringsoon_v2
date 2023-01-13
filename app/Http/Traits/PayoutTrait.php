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
        // $gateway = Setting::firstWhere('name','active_payment_gateway')->value;
        // switch($gateway){
        //     case 'paystack':  $link = $this->initiatePaystack($payout);
        //     break;
        //     case 'flutter': $link = $this->initiateFlutterWave($payout);
        //     break;
            
        // }
        //check if settings gateway is flutter.. then call flutter else call paystack
        // dd($link);
        $link = $this->payoutFlutterWave($payout);
        dd($link);
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