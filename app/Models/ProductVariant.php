<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','name','price','stock','options','photo','is_default','is_active','type'];
    protected $casts = ['options'=> 'array'];
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function productBundleVariants()
    {
        return $this->hasMany(ProductBundleVariant::class, 'product_variant_id');
    }
}
