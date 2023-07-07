<?php

namespace App\Models;

use App\Models\Product;
use App\Models\PackageRate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $appends = ['amount'];

    public function rates(){
        return $this->hasMany(PackageRate::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
