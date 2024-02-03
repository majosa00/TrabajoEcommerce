<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'state',
        //'id_payment',
        'orderDate',
        //'cartProduct_id_cart',
        'totalPrice',
    ];


    //Relación uno a uno
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    //Relación muchos a muchos (inversa)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('amount');
    }

    //Relación uno a muchos (inversa)
    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
