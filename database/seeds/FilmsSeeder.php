<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class FilmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i<=3; $i++){
            DB::table('films')->insert([
                'Name' => 'Film '.$i,
                'Slug' => preg_replace('/\s+/', '-', 'Film '.$i),
                'Description' => 'Description '.$i,
                'ReleaseDate' => date('Y-m-d'),
                'Rating' => 5,
                'TicketPrice' => rand(10,30),
                'Country' => 'USA',
                'Genre' => 'Action',
                'Photo' => 'https://source.unsplash.com/800x600',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

    }
}
