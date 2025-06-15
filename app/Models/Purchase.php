<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'store_id',
        'type',
        'completed_at',
        'refunded_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, 'paymentable');
    }
}
