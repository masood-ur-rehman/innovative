<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testsRequiresPasswordEmailAndName()
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJson([
                "message" =>"The given data was invalid.",
                "errors"=>[
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }

    public function testsRegistersSuccessfully()
    {
        $payload = [
            'name' => 'John',
            'email' => 'admin'.rand(10,999).'@example.com',
            'password' => 'Object12#',
            'c_password' => 'Object12#',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(200)
            ;
    }
}
