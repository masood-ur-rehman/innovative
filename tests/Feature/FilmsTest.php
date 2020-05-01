<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\LoginAPITrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FilmsTest extends TestCase
{
    use LoginAPITrait;
    //use WithoutMiddleware;
    /**
     * @var string
     */
    private $token;

    public function setUp(): void
    {
        parent::setUp();

        $this->token = $this->signInAPI();
    }

    /** @test */
    public function testGetFilms()
    {
        $this->json('GET',
            'api/films',
            [],
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer ' . $this->token,
            ]
        )->assertStatus(200);
    }

    public function testShowFilms()
    {
        $response = $this->get('films/film-1');

        $response->assertStatus(200);

    }

    public function SaveFilms()
    {
        $this->json('POST',
            'api/films',
            [
                'Name' => 'Film 55',
                'Description' => 'Desc 1',
                'ReleaseDate' => date('Y-m-d'),
                'Rating' => rand(1,5),
                'TicketPrice' => rand(1,99),
                'Country' => 'USA',
                'Genre' => 'Animation',
                'Photo' => UploadedFile::fake()->image('random.jpg'),
                'created_at' => date('Y-m-d H:i:s'),

            ],
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Bearer ' . $this->token,
            ]
        )
            ->assertStatus(200)
            ->assertJson([
                "status" =>true,
                "message"=> "Film Saved Successfully"
            ]);


    }
}
