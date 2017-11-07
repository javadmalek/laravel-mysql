<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfqs', function (Blueprint $table) {
            $table->increments('id');

            //$table->string('_sector_id');
            //$table->string('_sub_sector_id');
            //$table->string('_group_id');
            //$table->string('_company_id');
            $table->string('_channel_id');

            $table->string('title');
            $table->date('deadline');
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
        Schema::drop('rfqs');
    }
}
