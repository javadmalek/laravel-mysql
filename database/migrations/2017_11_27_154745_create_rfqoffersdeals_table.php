<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfqoffersdealsTable extends Migration
{
    public function up()
    {
        Schema::create('rfqoffersdeals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('_offer_id');
//            $table->string('_purchaser_id');
//            $table->string('_supplier_id');

            $table->string('status');
            $table->string('purchaser_terminate_status');
            $table->string('purchaser_terminate_descr');
            $table->timestamp('purchaser_terminate_at');
            $table->string('supplier_terminate_status');
            $table->string('supplier_terminate_descr');
            $table->timestamp('supplier_terminate_at');
            $table->string('payment_status');
            $table->string('description');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('rfqoffers');
    }
}
