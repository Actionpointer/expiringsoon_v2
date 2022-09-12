<?php

namespace App\Models;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Kyc extends Model
{
    use HasFactory;
    public $table = 'kyc';

    protected $fillable = ['shop_id','user_id','type','doctype','document'];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\KycObserver);
    }
    
}
