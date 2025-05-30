<?php

namespace App\Models;


use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentItem extends Model
{
    use HasFactory;

    protected $fillable = ['payment_id','paymentable_id','paymentable_type'];

    public function paymentable(){
        return $this->morphTo();
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    

    // public function 

}
