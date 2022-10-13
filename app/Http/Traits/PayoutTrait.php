<?php
namespace App\Http\Traits;
use App\Models\Payout;
use App\Models\Setting;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;


trait PayoutTrait
{
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
        $link = $this->initiateFlutterWave($payout);
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
    
    protected function initiateFlutterWave(Payout $payout){
        $currency = cache('settings')['currency_iso'];
        
        $response = Curl::to('https://api.flutterwave.com/v3/transfers')
        ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
        // ->withData( array('account_number'=> $payout->account->account_number,'account_bank'=> $payout->account->bank->code,
        ->withData( array('account_number'=> '0690000032','account_bank'=> '044',
            'amount'=> $payout->amount,'narration'=> "Vendor payout with reference $payout->reference",'reference'=> $payout->reference,
                        "currency"=> $currency,'callback_url '=> route('payout.callback'),
                        "customizations"=> [
                            "title"=>"Expiring Soon",
                            "description"=>"Payment",
                            "logo"=> asset('src/images/logo.png')
                        ]) )
        ->asJson()
        ->post();
        dd($response);
        if(!$response || $response->status == 'error' || $response->data->status = 'FAILED'){
            $payout->transfer_id = $response->data->id ?? '';
            $payout->status = 'failed';
            $payout->save();
            return false;
        }
        if($response && $response->status == 'success' || $response->data->status = 'NEW'){
            $payout->transfer_id = $response->data->id ?? '';
            $payout->status = 'processing';
            $payout->save();
            return true;
        }
        
    }

    public function initiatePaystack(Payout $payout){
        $user = auth()->user();
        $currency = cache('settings')['currency_iso'];
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
    
    protected function retryFlutterWave(Payout $payout){
        $response = Curl::to("https://api.flutterwave.com/v3/transfers/$payout->transfer_id/retries")
            ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
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

    protected function fetchFlutterWave(Payout $payout){
        $response = Curl::to("https://api.flutterwave.com/v3/transfers/$payout->transfer_id")
            ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
            ->asJson()
            ->get(); 
    }
    
    protected function resolveBankAccountByFlutter($account_number,$bank,$bvn){
        // $response = Curl::to('https://api.flutterwave.com/v3/accounts/resolve')
        // $response = Curl::to('https://api.flutterwave.com/v3/kyc/bvns/'.$bvn)
        //         ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
        //         ->withHeader('Content-Type: application/json')
        //         // ->withData( array('bvn'=> $bvn) )
        //         ->asJson()
        //         ->get();
        // dd($response);
        // $result['name'] = $response->data->firstname;
        // $response = Curl::to('https://api.flutterwave.com/v3/accounts/resolve')
        //     ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
        //     // ->withHeader('Content-Type: application/json')
        //     ->withData( json_encode(array("account_number" => $account_number,"account_bank" => $bank)) )
        //     ->asJson()
        //     ->post();
        // dd($response);
        if($account_number && $bank && $bvn)
        return 'Ronaldo Messi';
        else return false;
        
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

    protected function getBanksByFlutterWave(){
        
    }

    protected function getBanksByPaystack(){
        
    }

}