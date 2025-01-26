<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'company_name',
        'registration_number',
        'tax_number',
        'phone',
        'website',
        'description',
        'status',
        'is_featured',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasOne(SellerDetail::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
