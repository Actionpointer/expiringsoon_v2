<?php

namespace App\Jobs;

use App\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\InvoiceNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SubscriptionRenewalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $invoices = Invoice::where('paid',false)->where('due_date','>',now())->get();
        foreach($invoices as $invoice){
            if(($invoice->due_date->diffInHours(now()) > 48 && $invoice->due_date->diffInHours(now()) < 72) || $invoice->due_date->diffInDays(now()) == 0){
                //send an email
                $invoice->customer->notify(new InvoiceNotification($invoice));
            }
        }
        $invoices = Invoice::where('paid',false)->where('due_date','<',now())->get();
        foreach($invoices as $invoice){
            if(now()->format('d') % 7 == $invoice->due_date->format('d')%7){
                //send an email
                $invoice->customer->notify(new InvoiceNotification($invoice));
            }
        }

        
    }
}
