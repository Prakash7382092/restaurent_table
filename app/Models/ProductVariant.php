<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariantFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'variant_name',
        'attribute_value_ids',
        'base_price',
        'original_price',
        'width',
        'height',
        'breadth',
        'length',
        'stock',
        'availability',
        'status',
    ];

    protected $casts = [
        'availability' => 'boolean',
        'status' => 'boolean',
        'base_price' => 'decimal:2',
        'original_price' => 'decimal:2',
    ];
}
