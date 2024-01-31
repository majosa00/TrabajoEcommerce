<?php

// App\Models\Cart.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Relación uno a uno con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relación muchos a muchos (inversa)
    public function product ()
    {
        return $this->belongsToMany(Product::class);
    }
}
