<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            /*$table->enum('rol', ['admin', 'user'])->default('user');
            //Para el Middleware, que comprueba si el usuario es administrador o no. Usuario por defecto*/
            $table->unsignedBigInteger('rol_id')->unique();
            
            $table->foreign('rol_id')
                    ->references('id')
                    ->on('rols')
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
        Schema::dropIfExists('users');
    }

};
