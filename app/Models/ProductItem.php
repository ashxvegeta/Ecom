<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class ProductItem extends Model
{
    //
    use HasFactory;
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
