<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'gender' => 'male',
            'email' => 'admin@gmail.com',
            'password' => Hash::make("123"),
            'is_admin' => true,
        ]);

        Movie::factory()->count(100)->create();
    }
}
