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
        'percent_of'
    ];

    public function discount ($total) {

        //Si el cupón es fijo
        if ($this->type == "fixed") {
            return $this->value;
        } elseif ($this->type == "percent") {
            return ($this->percent_of/100) * $total;
        } else {
            return 0;
        }
    }

}
