<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'flavor',
        'brand',
        'price',
        'dimension',
        'udpack',
        'weigth',
        'stock',
        'iva',
    ];

    public function image()
    {
        return $this->hasMany(Image::class, 'foreign_key', 'local_key');
    }

    public function ingredient()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
}
