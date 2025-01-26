<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{

    protected $fillable =['name'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function values()
    {
        return $this->hasMany(ProductOptionValue::class);
    }
}
