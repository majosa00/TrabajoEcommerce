<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relación muchos a muchos (inversa)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'wishlist_product');
    }
}
