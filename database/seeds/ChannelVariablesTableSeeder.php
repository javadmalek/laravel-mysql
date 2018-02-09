<?php

use Illuminate\Database\Seeder;

class ChannelVariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ChannelVariable::class, 1)->create();
    }
}
