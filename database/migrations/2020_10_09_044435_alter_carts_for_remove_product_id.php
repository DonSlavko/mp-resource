<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCartsForRemoveProductId extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('variation_value_id');
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('variation_value_id')->unsigned();
        });
    }
}
