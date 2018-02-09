<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelvariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channelvariables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('_channel_id');

            $table->string('title');
            $table->string('variable');   // T: TYPE(TIPOLOGIA), D: DIMENSION, M: MATERIAL

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
        Schema::drop('channelvariables');
    }
}
