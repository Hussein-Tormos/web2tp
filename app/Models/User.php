<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
    ];

    /**
     * 
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'is_admin' => false,
    ];
}
