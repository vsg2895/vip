<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostIdFieldToImagesOrigianlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_originals', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_originals', function (Blueprint $table) {
            $table->dropColumn('post_id');
            $table->dropColumn('user_id');
        });
    }
}
