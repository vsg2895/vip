<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSparePartStoreIdToPostImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_images', function (Blueprint $table) {

            $table->integer('spare_part_store_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_images', function (Blueprint $table) {

            $table->dropColumn('spare_part_store_id');
        });
    }
}
