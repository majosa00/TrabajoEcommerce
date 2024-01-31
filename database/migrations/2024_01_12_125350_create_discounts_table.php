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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();

            $table->float('price');
            $table->float('discount');

            $table->unsignedBigInteger('product_id')->unique();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                //Si se elimina el producto, se elimina este descuento
                ->onUpdate('cascade'); //Si el producto cambia el id, se cambia el id de este descuento

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
