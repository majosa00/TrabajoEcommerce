<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function user ()
    {
        return $this->belongsTo(User::class, 'foreign_key', 'owner_key');
    }

    public function product () {
        return $this->belongsToMany(Product::class, 'rol_user', 'user_id', 'rol_id');
    }
}
