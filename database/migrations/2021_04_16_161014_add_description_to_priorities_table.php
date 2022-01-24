<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToPrioritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_priorities', function (Blueprint $table) {
            $table->longText('description_en');
            $table->longText('description_ru');
            $table->longText('description_hy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_priorities', function (Blueprint $table) {
            $table->dropColumn('description_en');
            $table->dropColumn('description_ru');
            $table->dropColumn('description_hy');
        });
    }
}
