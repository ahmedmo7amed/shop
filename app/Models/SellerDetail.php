<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'seller_id',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'bank_name',
        'bank_account_number',
        'bank_holder_name',
        'bank_swift_code',
        'social_media',
        'return_policy',
        'shipping_policy',
    ];

    protected $casts = [
        'social_media' => 'array',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
