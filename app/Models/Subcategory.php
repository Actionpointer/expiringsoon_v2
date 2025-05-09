<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory;
    public $table = 'subcategories';

    protected $fillable = ['category_id','subcategory_id'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tag(){
        return $this->belongsTo(Tag::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
