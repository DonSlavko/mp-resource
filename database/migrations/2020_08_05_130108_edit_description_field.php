<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditDescriptionField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
        Schema::table('attributes', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
        Schema::table('variations', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
        Schema::table('variation_values', function (Blueprint $table) {
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('description');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('description');
        });
        Schema::table('attributes', function (Blueprint $table) {
            $table->string('description');
        });
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->string('description');
        });
        Schema::table('variations', function (Blueprint $table) {
            $table->string('description');
        });
        Schema::table('variation_values', function (Blueprint $table) {
            $table->string('description');
        });
    }
}
