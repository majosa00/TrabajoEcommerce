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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('caffeine', 45);
            $table->string('taurine', 45);
            $table->string('sugars', 45);
            $table->string('bvitamins', 45);
            $table->string('aminoacids', 45);
            $table->string('plantherb', 45);
            $table->string('electrolytes', 45);
            $table->string('inositol', 45);
            $table->string('gaba', 45);
            $table->string('guarana', 45);
            $table->string('carnitine', 45);
            $table->string('niacin', 45);
            $table->string('riboflavin', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
