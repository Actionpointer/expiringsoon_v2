<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBundleVariant extends Model
{
    use HasFactory;
    protected $fillable = ['product_bundle_id', 'product_variant_id'];

    public function bundle()
    {
        return $this->belongsTo(ProductBundle::class, 'product_bundle_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
