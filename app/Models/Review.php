<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'restaurent_id',
        'rating',
        'comments',
        'images',
        'is_approved'
    ];

    protected $casts = [
        'images' => 'array',
    ];

      
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

   
    public function restaurent()
    {
        return $this->belongsTo(Restaurent::class, 'restaurent_id');
    }
}
