<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rols', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->unsignedBigInteger('user_id')->unique();
            
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade') //Si se elimina el usuario, se elimina este rol
                    ->onUpdate('cascade'); //Si el usuario cambia el id, se cambia el id de este rol

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rols');
    }
};
