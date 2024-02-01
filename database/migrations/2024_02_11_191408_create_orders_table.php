<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            //$table->integer('product_id');
            $table->integer('user_id');
            $table->string('state');
            //$table->integer('payment_id');
            $table->date('orderDate');
            //$table->integer('cartProduct_id_cart');
            $table->float('totalPrice');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
