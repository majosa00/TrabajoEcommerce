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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id')->unique();
            $table->foreign('order_id')
                    ->references('id')
                    ->on('orders')
                    //Si se elimina el pedido, se elimina esta factura
                    ->onUpdate('cascade'); //Si el pedido cambia el id, se cambia el id de esta factura

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
