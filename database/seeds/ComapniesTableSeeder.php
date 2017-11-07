<?php

use Illuminate\Database\Seeder;

class ComapniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Company::class, 1)->create();
    }
}
