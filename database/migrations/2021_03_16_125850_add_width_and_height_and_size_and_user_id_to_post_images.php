<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWidthAndHeightAndSizeAndUserIdToPostImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_images', function (Blueprint $table) {
            $table->string('width');
            $table->string('height');
            $table->string('size');
            $table->integer('user_id');

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
            $table->dropColumn('width');
            $table->dropColumn('height');
            $table->dropColumn('size');
            $table->dropColumn('user_id');
        });
    }
}
