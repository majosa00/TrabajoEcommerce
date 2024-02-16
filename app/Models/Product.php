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
        'brand_id',
        'price',
        'dimension',
        'udpack',
        'weight',
        'stock',
        'iva',
        'is_hidden',
    ];


    // Relación uno a uno
    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    // Relación uno a uno
    public function images()
    {
        return $this->hasOne(Image::class);
    }

    // Relación muchos a muchos
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('amount');
    }

    // Relación muchos a muchos
    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('amount');
    }

    // Relación muchos a muchos
    public function ingredient()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    // Relación muchos a muchos
    public function wishlist()
    {
        return $this->belongsToMany(Wishlist::class);
    }

    // Relación uno a muchos (inversa).
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Oculta el producto estableciendo 'is_hidden' en true.
     */
    public function hide()
    {
        $this->is_hidden = true;
        $this->save();
    }

    /**
     * Muestra el producto estableciendo 'is_hidden' en false.
     */
    public function show()
    {
        $this->is_hidden = false;
        $this->save();
    }
}
