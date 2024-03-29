<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'user_id',
        'start_date',
        'end_date',
        'max_users',
        'brand_id',
        'product_id',
        'max_products'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_discount');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
