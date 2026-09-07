<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_item_id',
        'quantity',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productItem()
    {
        return $this->belongsTo(ProductItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    

    


}
