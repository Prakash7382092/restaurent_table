<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['name','code'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_attributes');
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
