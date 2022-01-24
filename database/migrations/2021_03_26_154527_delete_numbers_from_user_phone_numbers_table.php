<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteNumbersFromUserPhoneNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_phone_numbers', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('viber');
            $table->dropColumn('whatsapp');
            $table->dropColumn('telegram');
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
            //
        });
    }
}
