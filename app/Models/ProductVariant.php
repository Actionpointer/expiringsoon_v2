<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','name','price', 'options','stock','status'];
    protected $casts = ['options' => 'array', 'is_default' => 'boolean','is_active' => 'boolean','price' => 'decimal:2',];

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
