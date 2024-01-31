<?php

// App\Models\Cart.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    // Relación uno a uno con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relación muchos a muchos (inversa)
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }
}
