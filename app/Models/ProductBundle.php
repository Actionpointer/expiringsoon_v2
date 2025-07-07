<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBundle extends Model
{
    use HasFactory;

    protected $fillable = ['store_id','name','currency_code','published','photo', 'price'];

    protected $appends = ['sumup_price'];

    public function productBundleVariants()
    {
        return $this->hasMany(ProductBundleVariant::class);
    }

    public function getSumupPriceAttribute()
    {
        return $this->productBundleVariants->load('variant')->sum(function ($bundleVariant) {
            return $bundleVariant->variant->price ?? 0;
        });
    }
}
