<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //

     protected $fillable = [
        'product_id',
        'image_path',
        'sort_order'
    ];

    // A ProductImage belongs to one Product
    public function  product(){
        return $this->belongsTo(Product::class);
    }

}
