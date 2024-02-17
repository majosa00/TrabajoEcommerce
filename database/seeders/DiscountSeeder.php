<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Discount::create([
            "code" => "ENER25",
            "type" => "fixed",
            "percent_of" => 25,
        ]);
    }
}
