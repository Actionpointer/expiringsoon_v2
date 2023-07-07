<?php

namespace App\Models;

use App\Models\User;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory,SoftDeletes;
    
    public $table = 'cart';

    protected $fillable = ['user_id','product_id','quantity','shop_id','amount','total'];
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public function getDeliveryCostAttribute(){
        return $this->product->shop->packageRates->firstWhere('package_id',$this->product->package_id)->amount * $this->quantity;
    }
    
    
}
