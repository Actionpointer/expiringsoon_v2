<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGiveaway extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_variant_id',
        'price',
        'currency_code',
        'max_per_user',
        'quantity',
        'start_at',
        'end_at',
        'only_customers',
        'published'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'only_customers' => 'boolean',
        'published' => 'boolean',
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function product()
    {
        return $this->hasOneThrough(Product::class, ProductVariant::class, 'id', 'id', 'product_variant_id', 'product_id');
    }
}
