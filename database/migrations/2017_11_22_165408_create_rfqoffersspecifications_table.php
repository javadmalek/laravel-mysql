<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfqoffersspecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfqoffersspecifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('_offer_id');
            $table->string('_rfqspec_id');

            $table->string('type');   // TEXT or YESNO
            $table->string('value');

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
        Schema::drop('rfqoffersspecifications');
    }
}
