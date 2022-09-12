<?php

namespace App\Models;

use App\Models\User;
use App\Models\PaymentItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['reference','method','user_id','status','amount'];

    public function items(){
        return $this->hasMany(PaymentItem::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getRouteKeyName(){
        return 'reference';
    }
}
