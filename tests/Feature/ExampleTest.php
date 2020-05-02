<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use DatabaseMigrations;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->withoutMiddleware();
        $response = $this->call('get', '/films/film-1');
        //$response = $this->get('/films');
        //$this->assertTrue(true);
        //$response = $this->get('/');

        $response->assertStatus(200);
    }
}
