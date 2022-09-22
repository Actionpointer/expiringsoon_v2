<?php
namespace App\Http\Traits;
use App\Models\Payment;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;


trait PaymentTrait
{
    protected function initializePayment($amount,$items,$type){
        $gateway = cache('settings')['active_payment_gateway'];
        $user = Auth::user();
        $payment = Payment::create(['user_id'=> $user->id,'reference'=> uniqid(),'amount'=> $amount ,'vat'=> cache('settings')['vat']]);
        switch($gateway){
            case 'paystack': $link = $this->initiatePaystack($payment,$items,$type);
            break;
            case 'flutter': $link = $this->initiateFlutterWave($payment,$items,$type);
            break;
            default: dd('which one is this');
            break;
        }
        return $link;
    }
    
    protected function initiateFlutterWave(Payment $payment,$items,$type){
        $response = Curl::to('https://api.flutterwave.com/v3/payments')
        ->withHeader('Authorization: Bearer '.config('services.flutter.secret'))
        ->withData( array('customer' => ['email'=> $payment->user->email,'phonenumber'=> $payment->user->phone,'name'=> $payment->user->fname.' '.$payment->user->lname],
                        'tx_ref'=> $payment->reference,"currency" => cache('settings')['currency_iso'],"payment_options"=>"card,account,ussd",
                        "redirect_url"=> route('payment.callback'),'amount'=> $payment->amount,
                        'meta' => ['user_id'=> $payment->user->id,'items' => json_encode($items),'type'=> $type],
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

    public function initiatePaystack(Payment $payment,$items,$type){
      $response = Curl::to('https://api.paystack.co/transaction/initialize')
      ->withHeader('Authorization: Bearer '.config('services.paystack.secret'))
      ->withHeader('Content-Type: application/json')
      ->withData( array('email'=> $payment->user->email,'amount'=> $payment->amount*100,'currency'=> cache('settings')['currency_iso'],
                      'reference'=> $payment->reference,"callback_url"=> route('payment.callback'),
                      'metadata' => json_encode(['user_id'=> $payment->user->id,'items' => json_encode($items),'type'=> $type])
                      ) )
      
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

    protected function getPaymentData($option,$value){
        
        $gateway = cache('settings')['active_payment_gateway'];
        switch($option){
            case 'status': return in_array($value->status,['success',true]); 
                break;
            case 'trx_status': return in_array($value->data->status,['success','successful']);
                break;
            case 'amount': return $gateway == 'paystack' ? $value->data->amount/100 : $value->data->amount;
                break;
            case 'reference': return $gateway == 'paystack' ? $value->data->reference : $value->data->tx_ref;
                break;
            case 'items': return $gateway == 'paystack' ? json_decode($value->data->metadata->items) : json_decode($value->data->meta->items);
                break;
            case 'type': return $gateway == 'paystack' ? $value->data->metadata->type : $value->data->meta->type;
                break;
            case 'method': return $gateway == 'paystack' ? $value->data->channel : $value->data->payment_type;
                break;
        }  
    }
    // protected function getFlutterPaymentData($value){
    //     return 
    // }

    // protected function resolveBankAccount($account_bank,$account_number){
    //     $response = Curl::to('https://api.flutterwave.com/v3/accounts/resolve')
    //     ->withHeader('Authorization: Bearer '.config('services.flutter_test_secret_key'))
    //     ->withData( array('account_number'=> '0051911523',"account_bank" => '058') )
    //     ->asJson()
    //     ->post();
    //     return $response;  
    // }

 
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

//     if (isset($_GET['tx_ref'])) {
//         $ref = $_GET['tx_ref'];
//         $amount = $_GET['amount']; //Correct Amount from Server
//         $currency = "NGN"; //Correct Currency from Server

//         $query = array(
//             "SECKEY" => "FLWSECK-8033c67d90e0c53c91ae99c16ac78da8-X",
//             "txref" => $ref
//         );

//         $data_string = json_encode($query);

//         $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
//         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//         curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

//         $response = curl_exec($ch);

//         $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
//         $header = substr($response, 0, $header_size);
//         $body = substr($response, $header_size);

//         curl_close($ch);

//         $resp = json_decode($response, true);

//         $paymentStatus = $resp['data']['status'];
//         $chargeResponsecode = $resp['data']['chargecode'];
//         $chargeAmount = $resp['data']['amount'];
//         $chargeCurrency = $resp['data']['currency'];

//         if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
//         $newttl = $uqr['wallet'] + $chargeAmount;
//         $con->autocommit(FALSE);
//         $con->query("UPDATE users SET wallet='$newttl' WHERE id='".$uqr['id']."'");
//         $con->commit();
// header("Location: account.php?top=1");
// }
// }
// else{
// header("Location: account.php?top=0");
// }
// }

// if (isset($_GET['tx_ref'])) {
//     $ref = $_GET['tx_ref'];
//     $amount = $_GET['amount']; //Correct Amount from Server
//     $currency = "NGN"; //Correct Currency from Server

//     $query = array(
//         "SECKEY" => "FLWSECK-8033c67d90e0c53c91ae99c16ac78da8-X",
//         "txref" => $ref
//     );

//     $data_string = json_encode($query);
//     $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
//     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

//     $response = curl_exec($ch);

//     $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
//     $header = substr($response, 0, $header_size);
//     $body = substr($response, $header_size);

//     curl_close($ch);

//     $resp = json_decode($response, true);

//     $paymentStatus = $resp['data']['status'];
//     $chargeResponsecode = $resp['data']['chargecode'];
//     $chargeAmount = $resp['data']['amount'];
//     $chargeCurrency = $resp['data']['currency'];

//     if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
//     $query = "SELECT * FROM cart WHERE orderid='$orderid'";
//     $proddata = mysqli_query($con,$query);
//     while($row = mysqli_fetch_array($proddata)){

//     $pqq = mysqli_query($con, "SELECT * FROM products WHERE id='".$row['productid']."'");
//     $pqr = mysqli_fetch_assoc($pqq);
//     $newstock = $pqr['stock'] - $row['qty'];

//     $con->autocommit(FALSE);
//     $con->query("UPDATE products SET stock='$newstock' WHERE id='".$row['productid']."'");
//     $con->commit();
//     }

//     $query = "SELECT products.product as name, cart.qty as quantity, cart.total as amount FROM cart inner join products on cart.productid=products.id WHERE cart.orderid='".$orderid."' AND cart.status='Open' ORDER BY cart.date DESC";
//     $qq = mysqli_query($con, $query);
//     while ($value = mysqli_fetch_array($qq)){
//     $prm = mysqli_fetch_assoc($qq);
//     $j_pqr = json_encode($value);
//     }

//     $curl = curl_init();
//     curl_setopt_array($curl, array(
//         CURLOPT_URL => 'http://pick-it-ng.herokuapp.com/api/orders',
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => '',
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 0,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => 'POST',
//         CURLOPT_POSTFIELDS =>'{
//           "name": "'.$uqr['fname'].'",
//           "vehicles": "truck",
//           "pickupAddress": "N/A",
//           "address": "'.$uqr['address'].'",
//           "receivingPhone": "'.$uqr['phone'].'",
//           "weight": 5000,
//           "email": "'.$uqr['email'].'",
//           "city": "N/A",
//           "state": "'.$uqr['state'].'",
//           "items": [
//           '.$j_pqr.'
//         ]
//       }',
//         CURLOPT_HTTPHEADER => array(
//           'Authorization: 1ad5861e14ab27faa153',
//           'Content-Type: application/json'
//         ),
//       ));

//       // $response = curl_exec($curl);
//       // echo '<pre>'.$response.'<pre>';
//       $response = json_decode(curl_exec($curl), true);
//       curl_close($curl);
//       $trackingcode = $response['data']['trackingCode'];

//     $con->autocommit(FALSE);
//     $con->query("UPDATE cart SET status='Closed' WHERE userid='".$uqr['id']."' AND orderid='".$orderid."'");
//     $con->query("UPDATE orders SET status='Paid', paymentmethod='Card', deliverystatus='Processing', trackingcode='$trackingcode' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
//     if($oqr['recipient'] == 'None'){
//     $con->query("UPDATE orders SET recipient='".ucwords($uqr['fname'].' '.$uqr['lname'])."', deliverycontact='".$uqr['phone']."' WHERE userid='".$uqr['id']."' AND orderid='$orderid'");
//     }
//     $con->commit();

//     include 'library.php'; // include the library file
//     include "classes/class.phpmailer.php"; // include the class name
//     $mail = new PHPMailer(); // create a new object
//     $mail->IsSMTP(); // enable SMTP
//     $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
//     $mail->SMTPAuth = true; // authentication enabled
//     //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
//     $mail->Host = "mail.expiringsoon.shop";
//     $mail->Port = 465; // or 587
//     $mail->IsHTML(true);
//     $mail->Username = "no-reply@expiringsoon.shop";
//     $mail->Password = "Efiivuf-Gtej";
//     $mail->SetFrom("no-reply@expiringsoon.shop", "Expiring Soon");
//     $mail->AddAddress("".$uqr['email']."");
//     $mail->Subject = "Your order no. ".$orderid." is on its way!";
//     $mail->Body = file_get_contents("https://ng.expiringsoon.shop/receipt.php?ref=".$orderid."");
//     $mail->send();
//     include("vendor-notify.php?v=".$_GET['v']."");
// session_destroy();
// header("Location: invoice.php?ref=".$oqr['orderid']."&done");
// }
// }
// else{
// header("Location: checkout.php?pay=0");












}