<?php

namespace App\Listeners;

use App\User;
use App\Setting;
use App\Events\PaymentSuccessful;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DistributePaymentProceeds implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentSuccessful  $event
     * @return void
     */
    public function handle(PaymentSuccessful $event)
    {
        // Access the payment using $event->payment...
        //foreach payment->order.. give the shop vendors 95% of the total
        $settings = Setting::all();
        $vat_percentage = $settings->where('name','vat')->first()->value;
        $system_percentage = $settings->where('name','system_percentage')->first()->value;
        $incentive_percentage = $settings->where('name','incentive_percentage')->first()->value;
        $buyer_percentage = $settings->where('name','buyer_percentage')->first()->value;
        $parent_percentage = $settings->where('name','parent_percentage')->first()->value;
        $grand_parent_percentage = $settings->where('name','grand_parent_percentage')->first()->value;
        $great_grand_parent_percentage = $settings->where('name','great_grand_parent_percentage')->first()->value;
        $ancestor_percentage = $settings->where('name','ancestor_percentage')->first()->value;

        $vat_payment = $vat_percentage * $payment->amount / 100;
        $subtotal = $payment->amount - $vat_payment;
        
        $system_payment = $system_percentage * $subtotal / 100;

        $incentive_payment = $incentive_percentage * $subtotal / 100;
        $buyer_payment = $buyer_percentage * $subtotal / 100;
        $parent_payment = $parent_percentage * $subtotal / 100;
        $grand_parent_payment = $grand_parent_percentage * $subtotal / 100;
        $great_grand_parent_payment = $great_grand_parent_percentage * $subtotal / 100;
        $ancestor_payment = $ancestor_percentage * $subtotal / 100;

        $buyer = User::find($event->payment->user_id);
        $buyer->wallet += $buyer_payment;
        $buyer->save();
        //if parent payment
        if($buyer->parent_id){
            $parent = User::find($buyer->parent_id);
            $parent->wallet += $parent_payment;
            $parent->save();
            //if grand parent payment
            if($parent->parent_id){
                $grand = User::where($parent->parent_id);
                $grand->wallet += $grand_payment;
                $grand->save();
                // if great grand parent payment
                if($grand->parent_id){
                    $great_grand = User::find($grand->parent_id);
                    $great_grand->wallet += $great_grand_parent_payment;
                    $great_grand->save();
                    // grand parent payment
                    if($great_grand->parent_id){
                        $ancestor = User::find($great_grand->parent_id);
                        $ancestor->wallet += $ancestor_payment;
                        $ancestor->save();
                    }
                }
            }

        }

    }
}
