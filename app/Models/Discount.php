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
        'percent_of',
        'valid_until',
        'max_users',
        'category_id', //Para la categoría
        'product_id', //Para el producto
        'product_discount', //Para el descuento específico del producto
    ];

}
