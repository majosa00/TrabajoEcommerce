<?php

namespace Database\Seeders;

use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'id' => 1,
            'name' => 'Blue Chameleon',
            'description' => 'Blue late energy drink, 250 ml.',
            'ingredient' => 'Agua carbonatada, azúcar, acidulante (ácido cítrico), taurina (0,36%), corrector de acidez (citratos de sodio), cafeína (0,03%), glucuronolactona, colorante (E-150d), vitaminas (niacina, ácido pantoténico, vitamina B6, riboflavina, vitamina B12) y aroma.',
            'flavor' => "Carbonated",
            'price' => 0.8,
            'dimension' => 10,
            'udpack' => 1,
            'weight' => 28,
            'stock' => 0,
            'iva' => 0.21,
            'brand_id' => 3
        ]);

        Product::create([
            'id' => 2,
            'name' => 'Burn Energy Drink',
            'description' => 'Energy drink with a smooth and refreshing taste, 500 ml.',
            'ingredient' => 'Agua carbonatada, acidulante (ácido cítrico), taurina (0.4%), corrector de acidez (citratos de sodio), conservadores (sorbato potásico, benzoato sódico), colorante (E150d), edulcorantes (acesulfamo K, sucralosa), cafeína (0.03%), aromas, vitaminas (B3, B5, B6, B12), extracto de semilla de guaraná (0.005%).',
            'flavor' => "Carbonated",
            'price' => 4.60,
            'dimension' => 50,
            'udpack' => 4,
            'weight' => 2.17,
            'stock' => 3,
            'iva' => 0.21,
            'brand_id' => 4
        ]);

        Product::create([
            'id' => 3,
            'name' => 'Red Bull Regular',
            'description' => 'Optimal energy drink for when you need a boost, 250 ml.',
            'ingredient' => 'Agua, Sacarosa, Glucosa, Acidulante (Ácido Cítrico), Dióxido de Carbono, Taurina (0,4%), Correctores de Acidez (Carbonatos de Sodio, Carbonatos de Magnesio), Cafeína (0,03%), Vitaminas (Niacina, Ácido Pantoténico, B6, B12), Aromas, Colorantes (Caramelo Natural, Riboflavinas).',
            'flavor' => "Pink",
            'price' => 28,
            'dimension' => 25,
            'udpack' => 12,
            'weight' => 6.48,
            'stock' => 200,
            'iva' => 0.21,
            'brand_id' => 2
        ]);

        Product::create([
            'id' => 4,
            'name' => 'Monster Energy Original',
            'description' => 'Blue late energy drink, 250 ml.',
            'ingredient' => 'Agua carbonatada, sacarosa, jarabe de glucosa, acidulante (ácido cítrico), aromas, taurina (0.4%), corrector de acidez (citratos de sodio), extracto de raíz de panax ginseng (0.08%), L-carnitina L-tartrato (0.04%), conservadores (ácido sórbico, ácido benzoico), cafeína (0.03%), colorante (antocianinas), vitaminas (B3, B6, B2, B12), edulcorante (sucralosa), cloruro sódico, D-glucuronolactona, extracto de semilla de guaraná (0.002%), inositol, maltodextrina.',
            'flavor' => "Ginseng",
            'price' => 6.68,
            'dimension' => 50,
            'udpack' => 4,
            'weight' => 2.2,
            'stock' => 10,
            'iva' => 0.21,
            'brand_id' => 1
        ]);

    }
}
