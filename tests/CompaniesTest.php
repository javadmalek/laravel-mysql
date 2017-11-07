<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompaniesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    use DatabaseTransactions;

    public function testCompaonyCreation()
    {
        factory(App\Company::class)->create([
            'title' => 'Industrial Cloud SRL'
        ]);

        $this->seeInDatabase('Companies', ['title' => 'Industrial Cloud SRL']);
        print('The Companies Test is OK.');

    }
}