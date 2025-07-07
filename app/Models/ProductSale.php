<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','discount_percentage','start_at','end_at','frequency_minutes','duration_minutes','status'];
    protected $casts = ['start_at'=> 'datetime','end_at'=> 'datetime'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
