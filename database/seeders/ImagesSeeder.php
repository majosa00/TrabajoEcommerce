<?php

namespace Database\Seeders;

use App\Models\Image;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Image::create([
            'image1' => 'public\images\redbull.jpg',
            'product_id' => 3,
        ]);
    }
}
