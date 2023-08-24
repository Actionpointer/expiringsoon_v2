<?php

namespace App\Models;

use App\Models\User;
use App\Models\Rejection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kyc extends Model
{
    use HasFactory;
    public $table = 'kyc';

    protected $fillable = ['user_id','verifiable_id','verifiable_type','type','doctype','document','reason'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function verifiable(){
        return $this->morphTo();
    }
    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\KycObserver);
    }

    public function scopeWithin($query,$value = null){
        if($value){
            return $query->whereHas('user',function($p)use($value){
                $p->where('country_id',$value);
            });
        }
        elseif(auth()->check()){
            if(auth()->user()->role->name == 'superadmin')
            return $query;
            else return $query->whereHas('user',function ($q) { $q->where('country_id',auth()->user()->country_id); });
        }else{
            return $query->whereHas('user',function ($pq) { $pq->where('country_id',session('locale')['country_id']); });
        }  
    }

    public function rejections(){
        return $this->morphMany(Rejection::class,'rejectable');
    }

    public function rejected(){
        return $this->morphOne(Rejection::class,'rejectable');
    }
    
}
