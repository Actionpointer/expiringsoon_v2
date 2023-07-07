<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageRate extends Model
{
    use HasFactory;

    protected $fillable = ['package_id','shop_id','country_id','amount'];

    public function package(){
        return $this->belongsTo(Package::class);
    }
}
