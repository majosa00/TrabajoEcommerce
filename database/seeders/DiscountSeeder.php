<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discount;
use App\Models\User;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtén los primeros 10 usuarios
        $users = User::where('id', '<=', 10)->get();

        Discount::create([
            'code' => 'CODE1',
            'type' => 'simple',
            'value' => 10,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'user_id' => $users->random()->id,
            'max_users' => 10,
        ]);

       
    }
}
