<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $appends = ['category','category_id'];

    public function categories(){
        return $this->belongsToMany(Category::class,'subcategories');
    }

    public function getCategoryAttribute(){
        return $this->categories->first()->name;   
    }
    public function getCategoryIdAttribute(){
        return $this->categories->first()->id;   
    }
}
