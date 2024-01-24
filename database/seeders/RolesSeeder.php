<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol; 

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::create([
            'id' => '1',
            'name' => 'user',
           
        ]);

        Rol::create([
            'id' => '2',
            'name' => 'admin',
          
        ]);
    }
}
