<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,Sluggable;
    
    protected $fillable = ['name','photo','slug','is_active','group_by'];
    protected $appends = ['image'];
    protected $hidden = ['created_at','updated_at'];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]   
        ];
    }
    
    public function products(){
        return $this->hasMany(Product::class);
    }
    
    public function getImageAttribute(){
        return $this->photo ? asset("images/categories/$this->photo") :null;  
    }
}
