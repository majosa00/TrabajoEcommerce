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
            $table->string('code')->unique();
            $table->string('type'); // "simple", "category", "product"
            $table->integer('value')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable(); // Para cupones de usuario específico
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('max_users')->nullable(); // Número máximo de usuarios (opcional)
            $table->unsignedBigInteger('brand_id')->nullable(); // Para cupones de categoría
            $table->unsignedBigInteger('product_id')->nullable(); // Para cupones de producto
            $table->integer('max_products')->nullable(); // Número máximo de productos (opcional)
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
