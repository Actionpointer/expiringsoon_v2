<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $dates = ['expiry','uploaded'];

    public function like(){
        return $this->hasMany(Like::class);
    }
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    public function getAmountAttribute(){
        if($this->expiry->diffInDays(now()) <= 30)
            $discount = $this->shop->discounts->where('expiry',30)->first()->discount;
        elseif($this->expiry->diffInDays(now()) <= 60)
            $discount = $this->shop->discounts->where('expiry',60)->first()->discount;
        elseif($this->expiry->diffInDays(now()) <= 90)
            $discount = $this->shop->discounts->where('expiry',90)->first()->discount;
        else
            $discount = 0;
            $sale = $this->price - $discount;
        return $sale;
    }
}
