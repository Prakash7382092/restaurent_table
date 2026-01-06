<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    //  
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'phone_code',
        'email',
        'timezone',
        'logo',
        'country_id',
        'currency_id',
    ];

     public static function boot(){
        parent::boot();
        static::creating(function ($restaurant) {
            $restaurant->slug = Str::slug($restaurant->name);
        });
    }

}
