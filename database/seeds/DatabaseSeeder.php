<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        /// ToDo: Enable all before Installation

//        $this->call(ComapniesTableSeeder::class);
//        $this->call(ChannelsTableSeeder::class);
//        $this->call(ChannelVariablesTableSeeder::class);

//        $this->call(SectorsTableSeeder::class);
//        $this->call(SubsectorsTableSeeder::class);
//        $this->call(SubgroupsTableSeeder::class);*/

//        $this->call(RfqsTableSeeder::class);
//        $this->call(RfqSpecificationsTableSeeder::class);
//        $this->call(RfqOffersTableSeeder::class);
//        $this->call(RfqOffersDealsTableSeeder::class);

//        $this->call(AllCountriesSeeder::class);

        Model::reguard();
    }
}
