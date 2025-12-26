<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    use HasFactory;

    // Table name (optional if following Laravel naming conventions)
    protected $table = 'coupon_codes';

    // Mass assignable fields
    protected $fillable = [
        'code',
        'title',
        'description',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
    ];

    // Casts for automatic type conversion
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'discount_value' => 'decimal:2',
    ];

    /**
     * Check if the coupon is currently active
     */
    public function isActive()
    {
        $today = now()->toDateString();
        return $this->start_date <= $today && $this->end_date >= $today;
    }
}
