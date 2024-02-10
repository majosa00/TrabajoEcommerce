<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    //Relación 0 a 1 (inversa)
    // Brand.php
public function products()
{
    return $this->hasMany(Product::class, 'brand_id');
}

}
