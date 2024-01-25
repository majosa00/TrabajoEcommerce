<?php

namespace Database\Seeders;

use App\Models\Rol;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolsSeeder extends Seeder
{
    public function run(): void
    {
        Rol::create( [
            'id' => 1,
            'name' => 'user'

        ]);

        Rol::create( [
            'id' => 2,
            'name' => 'admin'

        ]);
    }
}
