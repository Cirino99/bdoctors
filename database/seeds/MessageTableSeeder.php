<?php

use App\Models\Message;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $messages = Message::all();

        foreach ($messages as $message) {
            $message->message = $faker->paragraphs(3);
            $message->date = $faker->date('d_m_y');
            $message->email = $faker->freeEmail();
        }
    }
}
