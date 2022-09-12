<?php

use App\Models\User;
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
        $users_ids = User::all()->pluck('id');

        foreach ($users_ids as $user_id) {
            $message = new Message();
            $message->message = implode($faker->paragraphs(3));
            $message->date = $faker->date('d_m_y');
            $message->email = $faker->freeEmail();
            $message->user_id = $user_id;
            $message->sender_receiver = "receiver";
            $message->save();
        }
    }
}
