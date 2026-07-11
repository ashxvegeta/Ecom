<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    //
    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'stock',
        'status',
    ];
// A ProductItem belongs to one Product
    public function  product(){
        return $this->belongsTo(Product::class);
    }



}
