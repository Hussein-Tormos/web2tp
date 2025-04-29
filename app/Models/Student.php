<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * 
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
    ];

    /**
     * 
     *
     * 
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date', // Automatically cast date_of_birth to a Carbon date object
    ];
}
