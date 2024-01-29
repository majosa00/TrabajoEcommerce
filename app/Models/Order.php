<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'id_user',
        'state',
        'id_payment',
        'orderDate',
        'cartProduct_id_cart',
        'totalPrice',
    ];


    //Relación uno a uno
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    //Relación muchos a muchos (inversa)
    public function product ()
    {
        return $this->belongsToMany(Product::class);
    }

}
