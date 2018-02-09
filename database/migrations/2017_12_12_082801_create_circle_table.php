<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircleTable extends Migration
{
    public function up()
    {
        Schema::create('circles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('_src_company_id');
            $table->string('_dst_company_id');

            // REQUESTED, ACCEPTED
            $table->string('status')->default('REQUESTED');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('circles');
    }
}
