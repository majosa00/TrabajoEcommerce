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
        Schema::create('wishlist_product', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('wishlist_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('wishlist_id')
                    ->references('id')
                    ->on('wishlists')
                   ;
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                   ;

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};