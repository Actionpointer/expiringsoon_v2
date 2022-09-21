<?php

namespace App\Models;

use App\Observers\PaymentItemObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentItem extends Model
{
    use HasFactory;

    protected $fillable = ['payment_id','paymentable_id','paymentable_type'];

    public function paymentable(){
        return $this->morphTo();
    }

    public static function boot()
    {
        parent::boot();
        parent::observe(new PaymentItemObserver);
    }
}
