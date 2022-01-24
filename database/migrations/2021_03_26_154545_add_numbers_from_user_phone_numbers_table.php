<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumbersFromUserPhoneNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_phone_numbers', function (Blueprint $table) {
            $table->bigInteger('phone_number')->nullable();
            $table->bigInteger('viber')->nullable();
            $table->bigInteger('whatsapp')->nullable();
            $table->bigInteger('telegram')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_phone_numbers', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('viber');
            $table->dropColumn('whatsapp');
            $table->dropColumn('telegram');
        });
    }
}
