<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    //Relación uno a uno
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    //Relación muchos a muchos (inversa)
    public function products ()
    {
        return $this->belongsToMany(Product::class);
    }

}
