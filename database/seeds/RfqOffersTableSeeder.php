<?php

use Illuminate\Database\Seeder;

class RfqOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RfqOffer::class, 1)->create();
    }
}
