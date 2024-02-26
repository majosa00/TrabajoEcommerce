<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Productos
        Image::create([
            'imagen_1' => 'images/chamaleon.png',
            'product_id' => 1
        ]);

        Image::create([
            'imagen_1' => 'images/burn.png',
            'product_id' => 2
        ]);

        Image::create([
            'imagen_1' => 'images/redbull.png',
            'product_id' => 3
        ]);

        Image::create([
            'imagen_1' => 'images/monster.png',
            'product_id' => 4
        ]);

        //Marcas
        Image::create([
            'imagen_1' => 'images/brandmonster.png',
            'brand_id' => 1
        ]);

        Image::create([
            'imagen_1' => 'images/brandredbull.png',
            'brand_id' => 2
        ]);

        Image::create([
            'imagen_1' => 'images/brandchamaleon.png',
            'brand_id' => 3
        ]);
        
        Image::create([
            'imagen_1' => 'images/brandburn.png',
            'brand_id' => 4
        ]);
    }
}
