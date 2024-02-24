<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'percent_of',
        'user_id',
        'start_date',
        'end_date',
        'max_users',
        'brand_id', 
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }


public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}