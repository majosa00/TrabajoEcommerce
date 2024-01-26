<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'foreign_key', 'local_key');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'rol_user', 'user_id', 'rol_id');
    }
}
