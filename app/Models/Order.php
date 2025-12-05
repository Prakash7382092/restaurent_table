<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total_amount',
        'delivery_charges',
        'discount_amount',
        'total_payable',
        'status',
        'shipping_address_id',
        'shipping_tracking_code',
        'payment_method',
        'order_currency',
        'transaction_id',
    ];
    protected $casts = [
        'total_amount' => 'decimal:2',
    ];
}
