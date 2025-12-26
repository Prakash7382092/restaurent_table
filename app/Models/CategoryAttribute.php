<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    //
     protected $table = 'category_attributes';
    protected $fillable = ['category_id','attribute_id'];

     public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function attribute()
    {
        return $this->belongsTo(\App\Models\Attribute::class);
    }
}
