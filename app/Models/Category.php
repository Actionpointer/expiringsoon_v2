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
        $tags = $this->subcategories->pluck('name');
        if($tags->count())
        return Product::where(function($query) use($tags) { foreach($tags as $tag){ $query->orWhereJsonContains("tags",$tag); } })->get();
        else return collect([]);
    }
    public function subcategories(){
        return $this->belongsToMany(Tag::class,'subcategories');
    }
    public function getImageAttribute(){
        return $this->photo ? asset("src/images/categories/$this->photo") :null;  
    }
}
