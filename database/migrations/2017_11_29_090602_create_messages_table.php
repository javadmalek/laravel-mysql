<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{

    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('_sender_user_id');
            $table->string('_sender_company_id');
            $table->string('_receiver_company_id');

            // [ Optional feature ]
            $table->string('_offer_id');
            $table->string('_rfq_id');

            $table->string('status');
            $table->text('subject');
            $table->text('message');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('messages');
    }
}
