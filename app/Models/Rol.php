<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    //Relación uno a uno
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
