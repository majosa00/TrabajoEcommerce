<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIsHiddenInProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_hidden')->default(false)->change();
        });
    }

    public function down()
    {
        // Ajusta según el estado deseado para rollback
    }
}
