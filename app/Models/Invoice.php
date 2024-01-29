<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    //Relación uno a uno 
    public function order ()
    {
        return $this->belongsTo(Order::class);
    }
}
