<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class HavronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // dd($request->all());
        $response = Curl::to('https://api.flutterwave.com/v3/payments')
        ->withHeader('Authorization: Bearer FLWSECK-cb976c2bae6a428a3819588a18c506b9-X')
        // ->withHeader('Authorization: Bearer FLWSECK_TEST-1db9db034477bdf8e83182d8b31e74cd-X')
        ->withData( array('customer' => ['email'=> $request->email,'phonenumber'=> $request->phone,'name'=> $request->name],
                        'tx_ref'=> uniqid(),"currency" => 'USD',"payment_options"=>"card,account,ussd",
                        "redirect_url"=> route('havron.callback'),'amount'=> $request->amount,
                        'meta' => ['type'=> 'donation'],
                        "customizations"=> [
                            "title" => "Havron360 Payments",
                            "description" => "This is a test payment for Dollar transaction",
                            "logo" => 'https://havron360.org/storage/app/media/logo.jpg'
                        ]) )
        ->asJson()
        ->post();
        if($response && $response->status == 'success')
            return redirect()->to($response->data->link);
        else return 'something went wrong';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function callback(){

        if(request()->query('status') != 'successful'){
            return 'Payment was not successful. Please try again';
        }
        $value = request()->query('tx_ref');
        $details = Curl::to('https://api.flutterwave.com/v3/transactions/verify_by_reference?tx_ref='.$value)
         ->withHeader('Authorization: Bearer FLWSECK-cb976c2bae6a428a3819588a18c506b9-X')
        //  ->withHeader('Authorization: Bearer FLWSECK_TEST-1db9db034477bdf8e83182d8b31e74cd-X')
         ->asJson()
         ->get();
        
        
        if(!in_array($details->status,['success',true])){
            return 'Payment was not successful. Please try again2';
        }
        if(!in_array($details->data->status,['success','successful'])){
            return 'Payment was not successful. Please try again3';
        }

        return 'Payment of USD '.$details->data->amount.' was Successful';

        
    }

    
   

    
}
