<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparePartsStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_parts_stores', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('desc_spare')->nullable();
            $table->string('img')->nullable();
            $table->integer('location_id');
            $table->string('address')->nullable();
            $table->integer('phone');
            $table->integer('brand_spare')->nullable();
            $table->integer('model_spare')->nullable();
            $table->integer('min_year_spare')->nullable();
            $table->integer('max_year_spare')->nullable();
            $table->integer('price')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('original');
            $table->integer('new');


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
        Schema::dropIfExists('spare_parts_stores');
    }
}
