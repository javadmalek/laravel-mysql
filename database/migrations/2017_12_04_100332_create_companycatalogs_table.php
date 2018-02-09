<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanycatalogsTable extends Migration
{
    public function up()
    {
        Schema::create('companycatalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('_company_id');

            // PRO: PRODUCT, SER: SERVICE, MAC:MACHINE
            $table->string('type')->default('PRO');

            $table->string('title');
            $table->string('application');
            $table->string('keywords');
            $table->string('standards');
            $table->string('crc');
            $table->string('price');
            $table->string('video');
            $table->string('logo');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('description');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('companycatalogs');
    }
}
