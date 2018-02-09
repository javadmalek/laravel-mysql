<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        '_company_id' => str_random(10),
        'type' => str_random(10),
    ];
});

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'title' => 'Industrial Cloud SRL',
        'slug' => 'industrial-cloud',
        'operation_type' => 'PURCHASER',
        'subscription_plan_type' => 'PREMIUM',

        'office_address' => ' Via Pier Carlo Boggio 59, 10138 Turin, IT',
        'office_tele' => '+39 011 090 33 34',

        'company_description' => $faker->paragraph,
        'web_url' => 'http://www.industrial-cloud.com',
        'contact_person' => 'Karim Zaitov',
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,

        'skype' => '',
        'fb' => '',
        'in' => '',
        'gplus' => '',
        'twitter' => '',

        'co_founder' => $faker->name,
        'cto' => $faker->name,
        'ceo' => $faker->name,
        'founding_year' => $faker->year('now'),
        'turnover' => '',
        'vat' => '',
        'employee_number' => $faker->numberBetween(0, 1000),

    ];
});

$factory->define(App\Channel::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'keywords' => $faker->word,
        'publish_type' => 'public',
        'description' => $faker->paragraph,
        '_company_id' => '1'
    ];
});

$factory->define(App\ChannelVariable::class, function (Faker\Generator $faker) {
    return [
        '_channel_id' => 1,

        'title' => $faker->sentence,
        'variable' => 'T'
    ];
});

//$factory->define(App\Sector::class, function (Faker\Generator $faker) {
//    return [
//        'status' => 'ACTIVE',
//
//        'title' => $faker->sentence,
//        'description' => $faker->paragraph,
//    ];
//});

//$factory->define(App\Subsector::class, function (Faker\Generator $faker) {
//    return [
//        '_sector_id' => 1,
//        'status' => 'ACTIVE',
//
//        'title' => $faker->sentence,
//        'description' => $faker->paragraph,
//    ];
//});

//$factory->define(App\Subgroup::class, function (Faker\Generator $faker) {
//    return [
//        '_sector_id' => 1,
//        '_subsector_id' => 1,
//        'status' => 'ACTIVE',
//
//        'title' => $faker->sentence,
//        'description' => $faker->paragraph,
//    ];
//});

$factory->define(App\Rfq::class, function (Faker\Generator $faker) {
    return [
        '_channel_id' => 1,
        '_type_id' => 1,
        '_dimension_id' => 1,

        'title' => $faker->sentence,
        'deadline' => '2017-11-06',
        'description' => $faker->paragraph,

        'internal_id' => 'VBS-213468984',
        'status' => 'DRAFTED',

        'expire_date' => '2017-11-06',
        'total_price' => '10,0000,000',
    ];
});

$factory->define(App\RfqSpecification::class, function (Faker\Generator $faker) {
    return [
        '_rfq_id' => 1,
        '_section' => 'PRICE',

        'key' => 'a price title',
        'type' => 'EURO',
        'value' => $faker->randomNumber(),
        'description' => $faker->sentence,
    ];
});

$factory->define(App\RfqOfferDeal::class, function (Faker\Generator $faker) {
    return [
        '_offer_id' => 1,
        '_purchaser_id' => 1,
//        '_supplier_id' => 1,

        'status' => 'POSTED',
        'description' => $faker->sentence,
    ];
});