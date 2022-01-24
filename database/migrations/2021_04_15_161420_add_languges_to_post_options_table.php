<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLangugesToPostOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_options', function (Blueprint $table) {
            $table->string('key_en');
            $table->string('key_ru');
            $table->string('key_hy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_options', function (Blueprint $table) {
            $table->dropColumn('key_en');
            $table->dropColumn('key_ru');
            $table->dropColumn('key_hy');
        });
    }
}
