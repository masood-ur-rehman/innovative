<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DatabaseMigrations;
use App\Models\User;
class LoginTest extends TestCase
{
    //use RefreshDatabase;


    protected function setUp():void {
        parent::setUp();
//        $this->user = factory('App\Models\User')->create([
//                        'email' => 'admin@example.com',
//            'password' => bcrypt('Object12#'),
//        ]);
    }

    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(401)
            ->assertJson([
                'error' => 'invalid_credentials'
            ]);
    }

    /** @test */
    public function testUserLoginsSuccessfully()
    {
//        parent::setUp();
//        $user = factory(\App\Models\User::class)->create([
//            'email' => 'testlogin@user.com',
//            'password' => bcrypt('1234578910'),
//        ]);
        $payload = ['email' => 'admin@example.com', 'password' => 'Object12#'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'token'
            ]);

    }
}
