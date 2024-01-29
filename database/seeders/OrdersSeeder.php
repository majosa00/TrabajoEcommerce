<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Para probar que funciona en borrador
        Order::create( [
            'id_product' => 1,
            'id_user' => 1,
            'state' => 'Pendiente',
            'id_payment' => 1,
            'orderDate' => '2024/03/12',
            'cartProduct_id_cart' => 1,
            'totalPrice' => 10
        ]);
    }
}
