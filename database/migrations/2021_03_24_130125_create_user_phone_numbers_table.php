<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhoneNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_phone_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('phone_country_id')->constrained('countries')->onDelete('cascade')->nullable();
            $table->integer('phone_number')->nullable();
            $table->foreignId('viber_country_id')->constrained('countries')->onDelete('cascade')->nullable();
            $table->integer('viber')->nullable();
            $table->foreignId('whatsapp_country_id')->constrained('countries')->onDelete('cascade')->nullable();
            $table->integer('whatsapp')->nullable();
            $table->foreignId('telegram_country_id')->constrained('countries')->onDelete('cascade')->nullable();
            $table->integer('telegram')->nullable();
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
        Schema::dropIfExists('user_phone_numbers');
    }
}
