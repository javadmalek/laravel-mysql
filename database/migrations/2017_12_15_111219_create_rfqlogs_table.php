<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfqlogsTable extends Migration
{
    public function up()
    {
        Schema::create('rfqlogs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('_user_id');
            $table->string('_rfq_id');

            // _offer_id could be null in some actions
            $table->string('_offer_id');

            $table->string('action');
            $table->string('description');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('circles');
    }
}

/*
 * List of Actions are as follows
 * ------------------------------
 * CREATE_RFQ
 * READ_OFFER
 * RFQ_EXPIRED
 * EDIT_RFQ
 * PUBLISHED_RFQ
 * ADD_SPEC
 * EDIT_SPEC
 * REMOVE_SPEC
 * REMOVE_RFQ
 * INVITE_SUPP
 * ACCEPT_OFFER
 * REJECT_OFFER
 * DEAL
 * TERMINATE_DEAL
 * CANCEL_RFQ
 * DUPLICATE_RFQ
 * OFFERING
 * EDIT_OFFER
 * CANCEL_OFFER
 * POST_OFFER
 * MSG_VIA_RFQ
 * CANCEL_REQ => request to cancel the RFQ
 * EXTENTION
 *
 *
 * */