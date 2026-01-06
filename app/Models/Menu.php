<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'restaurent_id',
        'menu_name',
        'sort_order',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurent_id');
    }
}
