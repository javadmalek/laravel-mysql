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

            $table->string('_channel_id');
            $table->string('_purchaser_company_id');
            $table->string('_type_id');
            $table->string('_dimension_id');
            $table->string('materials')->nullable();

            $table->string('internal_id');

            /*
             * PUBLIC: PUBLIC to all
             * PRIVATE: PRIVATE only for my circle
             * EU: Only for EU companies
             * US: Only for US companies
             * FAR-EAST: Only for Far-East companies
             * */
            $table->string('privacy')->default('PUBLIC');

            $table->string('title');
            $table->date('deadline');
            $table->date('deadline_time');
            $table->string('description')->nullable();

            $table->date('expire_date');
            $table->date('number_mold');
            $table->string('total_price');

            /*
             * DRAFTED:
             *          Drafting an RFQ but not published
             *          Nobody can see the RFQ then there is no offer
             * PUBLISHED:
             *            Publishing an RFQ
             *            The suppliers could make an offer
             *            The State would change by editing the RFQ
             *              - No edit/remove
             * NEGOTIATING:
             *            The deadline of the RFQ is passed then
             *              - No new offer
             *              - No edit/remove
             *              - The purchaser try to negotiate with suppliers and chose one of them
             * DEALING:
             *            One deal is made by purchaser
             *              - No new offer
             *              - No edit/remove
             * TERMINATED:
             *            Terminate the RFQ by the purchaser
             * */
            $table->string('status')->default('DRAFTED')	;
            $table->string('sponsor_id');
            $table->string('sponsor_name');
            $table->string('agent_id');
            $table->string('agent_name');

            $table->string('cancel_requested')->default('NO');
            $table->string('cancel_reason');
            $table->string('offer_extention');
            $table->string('is_extended')->default('NO');

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
