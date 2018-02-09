<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfqspecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfqspecifications', function (Blueprint $table) {
            $table->increments('id');

            $table->string('_rfq_id');
            $table->string('_section');

            $table->string('key');
            $table->string('type');   // TEXT or YESNO or Others
            $table->string('value');
            $table->string('is_mandatory')->default(1);
            $table->string('description')->nullable();

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
        Schema::drop('rfqspecifications');
    }
}
