<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'restaurent_id',
        'item_name',
        'image',
        'description',
        'type',
        'price',
        'is_available',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurent_id');
    }
}
