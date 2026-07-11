<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected $fillable = ['name','slug','parent_id','image','status'];

    // category belongs to its parents category
    public function parent(){

      return $this->belongsTo(Category::class,'parent_id');
      
    }

    // a category can have many childrens
    public  function children(){

        return $this->hasmany(Category::class,'parent_id');
    }

    //this category beolngs to many products using category_product  pivot table
    public function products(){
        
       return $this->belongsToMany(Product::class,'parent_id');
    }





}
