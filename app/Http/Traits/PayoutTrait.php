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
        $user = auth()->user();
        $gateway = $user->country->payout_gateway;
        if($gateway == 'flutterwave' && request()->query('status') != 'success'){
            //delete this order, and remove the order number from the cart
            return redirect()->route('home')->with(['result'=> 0,'message'=> 'Payout was not successful. Please try again']);
        }
        if($gateway == 'paystack'){
            $details = $this->verifyPaystackPayment(request()->query('reference'));
        }  
        else {
            $details = $this->verifyFlutterWavePayment(request()->query('tx_ref'));
        }
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