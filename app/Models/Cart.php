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

    public function unit_conversion($value,$unit){
        switch($unit){
            case 'in': return $value * 2.54;
                break;
            case 'g': return $value / 1000;
                break;
            case 'lb': return $value * 0.453592;
                break;
            case 'oz': return $value * 0.0283495;
                break;
            default: return $value;
                break;
        }
    }

    public function getDeliveryCostAttribute(){
        // dd($this->product);
        $dimension = $this->product->shop->dimension_rate *  $this->unit_conversion($this->product->length,$this->product->units[0]) *  $this->unit_conversion($this->product->width,$this->product->units[0]) *  $this->unit_conversion($this->product->height,$this->product->units[0]);
        $weight = $this->product->shop->weight_rate * $this->unit_conversion($this->product->weight,$this->product->units[1]);
        $total = $dimension + $weight;
        return $total * $this->quantity;

    }
    
    
}
