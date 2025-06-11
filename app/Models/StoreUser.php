<?php

namespace App\Models;


use App\Models\OrderMessage;
use App\Observers\StoreObserver;    
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreUser extends Pivot
{
    public $incrementing = true;
    
    protected $fillable = [
        'store_id','user_id','role_id','permissions','status'
    ];
    protected $casts = ['permissions'=> 'array'];
    
    
}
