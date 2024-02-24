<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discount;
use App\Models\User;
use App\Models\Brand; // Asegúrate de importar el modelo Brand

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtén los primeros 10 usuarios
        $users = User::where('id', '<=', 10)->get();

       
        $brand = Brand::inRandomOrder()->first();

        Discount::create([
            'code' => 'CODE1',
            'type' => 'simple',
            'value' => 10,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'user_id' => $users->random()->id,
            'max_users' => 10,
         
        ]);
        Discount::create([
            'code' => 'CODE2',
            'type' => 'category',
            'value' => 10,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'user_id' => $users->random()->id,
            'max_users' => 10,
            'brand_id' => $brand->id, 
        ]);
    }
}




