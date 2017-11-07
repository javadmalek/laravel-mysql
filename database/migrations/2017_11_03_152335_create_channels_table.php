<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('_sector_id');
            $table->string('_sub_sector_id');
            $table->string('_group_id');

            $table->string('keywords')->nullable();
            $table->string('publish_type')->default('public');

            $table->string('_company_id');
            $table->string('description');
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
        Schema::drop('channels');
    }
}
