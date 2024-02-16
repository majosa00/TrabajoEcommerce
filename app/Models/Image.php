<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['imagen_1', 'imagen_2', 'imagen_3'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
