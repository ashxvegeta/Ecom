<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //

    protected $fillable = ['name','logo','status'];
    
    // A Brand can have many Products
    public function products(){
        
        return $this->hasMany(Product::class,'brand_id');

    }



}
