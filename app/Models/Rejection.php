<?php

namespace App\Models;

use App\Observers\RejectionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rejection extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable  = ['reason','rejectable_id','rejectable_type','deleted_at'];

    public static function boot(){
        parent::boot();
        parent::observe(new RejectionObserver);
    }

    public function rejectable(){
        return $this->morphTo();
    }


}
