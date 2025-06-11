<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'purchaseable_id',
        'purchaseable_type',
        'price',
        'quantity',
        'amount',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function purchaseable()
    {
        return $this->morphTo();
    }
}
