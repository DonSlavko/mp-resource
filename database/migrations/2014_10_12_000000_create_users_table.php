<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('titles');

            $table->string('honorific');
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('last_name');

            $table->string('pharmacy');
            $table->string('street');
            $table->string('address')->nullable();
            $table->string('postal');
            $table->string('city');
            $table->string('phone');
            $table->string('fax');

            $table->boolean('subscribed')->default(0)->nullable();
            $table->boolean('active')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
