<?php

use Illuminate\Database\Seeder;
use App\Blog;
class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            Blog::create([
                'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'detail' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'user_id' => 1,
                'status' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
