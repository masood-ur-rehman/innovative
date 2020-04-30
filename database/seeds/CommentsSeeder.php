<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach($this->getFilms() as $film){
            DB::table('comments')->insert([
                'film_id' => $film->id,
                'user_id' => $this->getRandomUserId(),
                'Name' => $faker->name,
                'Comment' => $faker->paragraph,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    private function getFilms() {
        $films = \App\Models\Films::get();
        return $films;
    }

    private function getRandomUserId() {
        $user = \App\Models\User::inRandomOrder()->first();
        return $user->id;
    }
}
