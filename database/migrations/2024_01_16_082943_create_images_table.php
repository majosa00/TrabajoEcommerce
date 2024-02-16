<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            $table->string('imagen_1')->nullable(); 
            $table->string('imagen_2')->nullable(); 
            $table->string('imagen_3')->nullable(); 
            
            $table->unsignedBigInteger('product_id')->unique();
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    //Si se elimina el producto, se eliminan las fotos
                    ->onUpdate('cascade'); //Si el producto cambia el id, se cambia el id de estas fotos

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
