<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChannelTest extends TestCase
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

    public function testChannelCreation()
    {
        factory(App\Channel::class)->create([
            'title' => 'Metal Channel - test'
        ]);

        $this->seeInDatabase('channels', ['title' => 'Metal Channel - test']);
        print('The Channel Test is OK.');

    }

}
