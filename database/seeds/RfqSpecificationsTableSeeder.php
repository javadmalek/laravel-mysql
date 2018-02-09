<?php

use Illuminate\Database\Seeder;

class RfqSpecificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RfqSpecification::class, 1)->create();
    }
}
