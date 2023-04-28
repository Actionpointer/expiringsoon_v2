<?php
namespace App\Http\Traits;
use App\Models\Payout;
use App\Models\Payment;
use App\Models\Settlement;
use Ixudra\Curl\Facades\Curl;


trait FlutterwaveTrait
{
    
    protected function initiateFlutterWave(Payment $payment){
        $response = Curl::to('https://api.flutterwave.com/v3/payments')
        ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
        ->withData( array('customer' => ['email'=> $payment->user->email,'phonenumber'=> $payment->user->phone,'name'=> $payment->user->fname.' '.$payment->user->lname],
                        'tx_ref'=> $payment->reference,"currency" => session('locale')['currency_iso'],"payment_options"=>"card,account,ussd",
                        "redirect_url"=> route('payment.callback'),'amount'=> $payment->amount,
                        "customizations"=> [
                            "title" => "Expiring Soon",
                            "description" => "Payment",
                            "logo" => asset('src/images/logo.png')
                        ]) )
        ->asJson()
        ->post();
        if($response && $response->status == 'success')
            return $response->data->link;
        else return false;
    }
    
    protected function verifyFlutterWavePayment($value){
        $paymentDetails = Curl::to('https://api.flutterwave.com/v3/transactions/verify_by_reference?tx_ref='.$value)
         ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
         ->asJson()
         ->get();
        return $paymentDetails;
    }

    protected function refundFlutterWave(Settlement $settlement){
        $payment = $settlement->order->payment_item->payment;
        $id = $payment->request_id;
        $response = Curl::to("https://api.flutterwave.com/v3/transactions/$id/refund")
        ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
        ->withData( array('amount'=> $settlement->amount ) )
        ->asJson()
        ->post();
        if($response &&  isset($response->status) && $response->status == 'success')
        return true;
        else return false;
    }

    protected function fetchFlutterWave(Payout $payout){
        $response = Curl::to("https://api.flutterwave.com/v3/transfers/$payout->transfer_id")
            ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
            ->asJson()
            ->get(); 
    }
    //payouts
    protected function resolveBankAccountByFlutter($bank_code,$account_number){
        $response = Curl::to('https://api.flutterwave.com/v3/accounts/resolve')
            ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
            // ->withHeader('Content-Type: application/json')
            ->withData( json_encode(array("account_number" => $account_number,"account_bank" => $bank_code)) )
            ->asJson()
            ->post();
            // dd($response);
        if(!$response ||  !isset($response->status) || $response->status == "error"){
            return false;
        }
        return $response->data->account_name;
        
    }

    protected function payoutFlutterWave(Payout $payout){
        
        $response = Curl::to('https://api.flutterwave.com/v3/transfers')
        ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
        // ->withData( array('account_number'=> $payout->user->bankaccount->account_number,'account_bank'=> $payout->user->bankaccount->bank->code,
        ->withData( array('account_number'=> '0690000032','account_bank'=> '044','amount'=> $payout->amount,
                        'narration'=> "Vendor payout with reference $payout->reference",'reference'=> $payout->reference,
                        "currency"=> $payout->currency->iso,'destination_branch_code'=> $payout->user->bankaccount->branch->code,
                        'callback_url '=> route('payout.callback'),
                        "customizations"=> [
                            "title"=>"Expiring Soon",
                            "description"=>"Payment",
                            "logo"=> asset('src/images/logo.png')
                        ]) )
        ->asJson()
        ->post();
        
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

    protected function retryFlutterWave(Payout $payout){
        $response = Curl::to("https://api.flutterwave.com/v3/transfers/$payout->transfer_id/retries")
            ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
            ->asJson()
            ->get();
        //check the status and update
    }

    protected function verifyPayoutFlutterwave(){
        
    }

}