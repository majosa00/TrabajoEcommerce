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

    //Relación uno a uno
    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    //Relación uno a muchos
    public function image()
    {
        return $this->hasMany(Image::class);
    }

    //Relación muchos a muchos
    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    //Relación muchos a muchos
    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('amount');
    }

    //Relación muchos a muchos
    public function ingredient()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
