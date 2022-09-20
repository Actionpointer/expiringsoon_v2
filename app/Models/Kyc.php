<?php

namespace App\Models;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Kyc extends Model
{
    use HasFactory;
    public $table = 'kyc';

    protected $fillable = ['verifiable_id','verifiable_type','type','doctype','document','reason'];

    public function verifiable(){
        return $this->morphTo();
    }
    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\KycObserver);
    }
    
}
