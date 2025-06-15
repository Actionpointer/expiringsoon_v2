<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $appends = ['orphan'];

    public function categories(){
        return $this->belongsToMany(Category::class,'subcategories');
    }
    public function getOrphanAttribute(){
        return $this->categories->isEmpty();   
    }

    public function products(){
        return Product::whereJsonContains('tags',$this->name)->get();
    }
}
