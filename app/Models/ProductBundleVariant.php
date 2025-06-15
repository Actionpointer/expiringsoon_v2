<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBundleVariant extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','variant_id','price','stock','status'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    
}
