<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfqoffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfqoffers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('_rfq_id');
            $table->string('_supplier_company_id');
            $table->string('_purchaser_company_id');
            $table->bigInteger('total')->default(0);

            // NOTREAD, JUSTREAD, ACCEPTED, REJECTED, DEALING, CANCELED

            /*
             * DRAFTED:
             *          Drafting an offer by a supplier
             *          - Can do Edit/Cancel
             * WAITING:
             *          Sending the offer to purchaser
             *          - No edit and no cancel
             * REVIEWING:
             *          The RFQ deadline is passed
             *          - No edit and no cancel
             * REJECTED:
             *          The purchaser would reject the offer
             *          - No edit and no cancel
             * DEALING:
             *          The offer is accepted by the purchaser and they are in dealing.
             * TERMINATED:
             *          The deal in terminated and the offer too.
             * */
            $table->string('status')->default('WAITING');
            $table->string('is_read')->default('NOTREAD');
            $table->string('reason');

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
        Schema::drop('rfqoffers');
    }
}