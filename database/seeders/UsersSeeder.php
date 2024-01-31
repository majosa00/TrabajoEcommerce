<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'admin',
            'email' => 'majosaec@gmail.com',
            'password' => Hash::make('majosa00'),
            'rol_id' => 2,
            'email_verified_at' => '2024-01-31 13:01:45',
        ]);
        
    }
}
