<?php

namespace Database\Seeders;

use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        Product::create( [
            'id' => 1,
            'name' => 'Blue Chameleon',
            'description' => 'Bebida energética blue late, 250 ml.',
            'flavor' => "Carbonatado",
            'brand' => 'Blue Chameleon',
            'price' => 0.8,
            'dimension' => 10,
            'udpack' => 1,
            'weight' => 28,
            'stock' => 100,
            'iva' => 0.21
        ]);

        Product::create( [
            'id' => '2',
            'name' => 'Burn Energy Drink',
            'description' => 'Bebida energética con sabor suave y frescante, 500 ml.',
            'flavor' => "Carbonatado",
            'brand' => 'Burn',
            'price' => '4.60',
            'dimension' => '50',
            'udpack' => '4',
            'weight' => '2.17',
            'stock' => '50',
            'iva' => '0.21'
        ]);

        Product::create( [
            'id' => '3',
            'name' => 'Red Bull Regular',
            'description' => 'Bebida energética óptima para cuando necesitas un impulso, 250 ml.',
            'flavor' => "Rosa",
            'brand' => 'Red Bull',
            'price' => '28',
            'dimension' => '25',
            'udpack' => '12',
            'weight' => '6.48',
            'stock' => '200',
            'iva' => '0.21'
        ]);

        Product::create( [
            'id' => '4',
            'name' => 'Monster Energy Original',
            'description' => 'Bebida energética blue late, 250 ml.',
            'flavor' => "Ginseng",
            'brand' => 'Monster',
            'price' => '6.68',
            'dimension' => '50',
            'udpack' => '4',
            'weight' => '2.2',
            'stock' => '10',
            'iva' => '0.21'
        ]);

    }
}
