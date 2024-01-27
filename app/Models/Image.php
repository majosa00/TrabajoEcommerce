<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    //Relación uno a muchos (inversa)
    public function product ()
    {
        return $this->belongsTo(Product::class);
    }
}
