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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    //Si se elimina el usuario, se elimina este carrito
                    ->onUpdate('cascade'); //Si el usuario cambia el id, se cambia el id de este carrito

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
