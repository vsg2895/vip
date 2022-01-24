<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpareOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_options', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id');
            $table->integer('brand_spare');
            $table->integer('model_spare')->nullable();
            $table->integer('min_year_spare')->default(1990);
            $table->integer('max_year_spare')->default(2021);
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
        Schema::dropIfExists('spare_options');
    }
}
