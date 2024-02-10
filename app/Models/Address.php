<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    //Relación uno a muchos (inversa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
