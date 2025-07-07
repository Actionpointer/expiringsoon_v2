<?php

namespace App\Models;


use App\Models\Store;
use App\Models\User;   
use Illuminate\Database\Eloquent\Relations\Pivot;

class StoreUser extends Pivot
{
    public $incrementing = true;
    protected $table = 'store_users';
    
    protected $fillable = [
        'store_id','user_id','role_id','permissions','status'
    ];
    protected $casts = ['permissions'=> 'array','created_at'=> 'datetime'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }
    
}
