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
        foreach ($users_ids as $user_id) {
            $review = new Review;
            $review->user_id = $user_id;
            $review->review = implode($faker->paragraphs(3));
            $review->vote = $faker->numberBetween(1, 5);
            $review->date = $faker->date('Y_m_d');
            $review->name = $faker->firstName();
            $review->save();
        }
    }
}
