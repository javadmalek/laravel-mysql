<?php

use Illuminate\Database\Seeder;

class RfqOffersDealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RfqOfferDeal::class, 1)->create();
    }
}
