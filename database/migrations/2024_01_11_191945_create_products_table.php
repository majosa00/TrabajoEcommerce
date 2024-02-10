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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description');
            $table->string('flavor');
            $table->float('price');
            $table->float('dimension');
            $table->integer('udpack');
            $table->float('weight');
            $table->integer('stock');
            $table->float('iva');
            $table->unsignedBigInteger('brand_id'); 
            $table->foreign('brand_id') // Asegúrate de que el nombre de la columna aquí coincida con el definido arriba
            ->references('id') // Esto apunta a la columna 'id' en la tabla de 'brands'
            ->on('brands') // Esto especifica la tabla a la que la clave foránea hace referencia
            ->onDelete('cascade'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
