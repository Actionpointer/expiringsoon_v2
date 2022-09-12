<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function tag(){
        return $this->belongsToMany(Category::class,'subcategories');
    }
}
