<?php
/**
 * Created by PhpStorm.
 * User: masood
 * Date: 5/1/2020
 * Time: 3:56 AM
 */

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait LoginAPITrait
{
    public function signInAPI()
    {
        /** @var \Illuminate\Foundation\Testing\TestResponse $response */
        $response = $this->postJson('api/login', [
            'email' => 'admin@example.com',
            'password' => 'Object12#'
        ]);

        $response->assertStatus(200);
        $responseData = json_decode($response->getContent(), true);
        $this->assertTrue(isset($responseData['token']));

        return $responseData['token'];
    }
}
