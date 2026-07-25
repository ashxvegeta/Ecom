<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'brand_id',
        'status',
        'featured'
    ];

    // A Product belongs to one Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // A Product can belong to many Categories
    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_products');
    }

    // A Product can have many Product Images
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    // A Product can have many Product Items
    public function productItems()
    {
        return $this->hasMany(ProductItem::class);
    }
}