<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pricing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'regular_price',
        'sale_price',
        'sale_start',
        'sale_end',
        'wholesale_price',
        'min_wholesale_quantity',
        'is_on_sale',
    ];

    protected $casts = [
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
        'is_on_sale' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
