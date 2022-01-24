<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterInputOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_input_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filter_input_id')->constrained()->onDelete('cascade');
            $table->string('title_en');
            $table->string('title_ru');
            $table->string('title_hy');
            $table->integer('position_id')->default(1);
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
        Schema::dropIfExists('filter_input_options');
    }
}
