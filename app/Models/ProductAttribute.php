<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory,Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'options',
        'slug',
        'is_active',
    ];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name',
                'separator' => '_'
            ]
        ];
    }

    /**
     * Get the product options for this attribute.
     */
    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }

    /**
     * Get all products using this attribute.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_options');
    }
}
