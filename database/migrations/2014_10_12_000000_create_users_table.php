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
            $table->string('secondname')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('phone')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('rol_id');

            $table->foreign('rol_id')
                ->references('id')
                ->on('rols')
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
