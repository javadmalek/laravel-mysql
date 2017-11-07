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

        /// ToDo: Enable before Installation

//        $this->call(ComapniesTableSeeder::class);
//        $this->call(ChannelsTableSeeder::class);
        $this->call(RfqsTableSeeder::class);

        Model::reguard();
    }
}
