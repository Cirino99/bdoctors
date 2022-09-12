<?php

use DateInterval;
use App\Models\User;
use App\Models\Sponsorship;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class SponsorshipUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();
        $sponsorships = Sponsorship::all();
        $nSponsorships = count($sponsorships);

        foreach ($users as $user) {
            if ($user->id % 2 == 0) {
                //$sponsorship = $faker->randomElements($sponsorships, rand(0, $nSponsorships));
                $sponsorship = $sponsorships[1];
                $date = date('Y-m-d H:i:s');
                //$date_add = $date->add($sponsorship->time);
                $date_add = date("Y-m-d H:i:s", strtotime('+' . $sponsorship->time . 'hours'));
                //$date_add = $date->add(new DateInterval('P' . $sponsorship->time . 'H'));
                $attach_data[$user->id] = [
                    'sponsorship_id' => $sponsorship->id,
                    'starting_date' => $date,
                    'ending_date' => $date_add,
                    'id_paymant' => 1
                ];
                $user->sponsorships()->attach($attach_data);
            }
        }
    }
}
