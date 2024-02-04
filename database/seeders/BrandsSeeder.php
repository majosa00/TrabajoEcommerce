<?php

namespace Database\Seeders;

use App\Models\Brand;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    public function run(): void
    {
       Brand::create( [
            'name' => 'Monster',
        ]);

        Brand::create( [
            'name' => 'Red Bull',
        ]);

        Brand::create( [
            'name' => 'Blue Chameleon',
        ]);

        Brand::create( [
            'name' => 'Burn',
        ]);
    }
}
