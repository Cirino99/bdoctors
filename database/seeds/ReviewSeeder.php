<?php

use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users_ids = User::all()->pluck('id');

        for ($i = 0; $i < 20; $i++) {
            $review = new Review;

            $review->review = $faker->paragraphs(3);
            $review->vote = $faker->numberBetween(1, 5);
            $review->date = $faker->date('d_m_y');
            $review->name = $faker->firstName();

            $review->save();
        }
    }
}
