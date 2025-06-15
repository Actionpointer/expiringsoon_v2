<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'options',
        'is_active',
    ];

    protected $casts = [
        'option' => 'array',
    ];

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

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }
}
