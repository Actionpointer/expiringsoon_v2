<?php

namespace App\Models;

use App\Models\ThreadTalk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Support extends Model
{
    use HasFactory;
    protected $fillable = ['slug','profile_id','subject','description','priority','status'];
    
    public function getRouteKeyName(){
        return 'slug';
    }

    public function talks(){
        return $this->hasMany(ThreadTalk::class);
    }
}
