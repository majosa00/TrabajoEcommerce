<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relación uno a uno
    public function cart ()
    {
        return $this->hasOne(Cart::class);
    }

    //Relación uno a muchos (inversa)
    public function rol ()
    {
        return $this->belongsTo(Rol::class);
    }

    //Relación uno a muchos
    public function order ()
    {
        return $this->hasMany(Order::class);
    }

    //Relación uno a muchos
    public function address ()
    {
        return $this->hasMany(Address::class);
    }
}
