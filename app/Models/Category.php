<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','photo'];
    protected $appends = ['image'];
    protected $hidden = ['created_at','updated_at'];
    
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function subcategories(){
        return $this->belongsToMany(Tag::class,'subcategories');
    }
    public function getImageAttribute(){
        return $this->photo ? asset("src/images/categories/$this->photo") :null;  
    }
}
