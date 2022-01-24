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
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('phone');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('email');
            $table->string('role')->default('user');
            $table->string('img')->default('user.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('llc');
            $table->string('remember_token')->nullable();
            $table->integer('confirm')->default(0);
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
