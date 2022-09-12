<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function subcategories(){
        return $this->belongsToMany(Tag::class,'subcategories');
    }
}
