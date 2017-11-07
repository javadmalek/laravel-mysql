<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('operation_type');

            $table->string('subscription_plan_type');

            // Financial Information
            $table->string('co_founder');
            $table->string('cto');
            $table->string('ceo');
            $table->string('founding_year');
            $table->string('turnover')->nullable();
            $table->string('vat')->nullable();
            $table->string('employee_number')->nullable();

            // Basic Information
            $table->string('office_address');
            $table->string('office_tele');
            $table->string('company_description');
            $table->string('web_url')->nullable();
            $table->string('contact_person');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            // Social Media
            $table->string('skype')->nullable();
            $table->string('fb')->nullable();
            $table->string('in')->nullable();
            $table->string('gplus')->nullable();
            $table->string('twitter')->nullable();

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
        Schema::drop('companies');
    }
}
