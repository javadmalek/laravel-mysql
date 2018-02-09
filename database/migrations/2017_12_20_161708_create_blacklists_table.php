<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlacklistsTable extends Migration
{
    public function up()
    {
        Schema::create('blacklists', function (Blueprint $table) {
            $table->increments('id');

            $table->string('_blocker_company_id');
            $table->string('_blocked_company_id');
            $table->string('reasons');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('blacklists');
    }
}
