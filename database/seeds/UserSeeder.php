<?php

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = [
            [
                'name'      => 'asdf',
                'email'     => 'asdf@asdf.asdf',
                'password'  => Hash::make('asdf'),
            ],
            [
                'name'      => 'qwer',
                'email'     => 'qwer@qwer.qwer',
                'password'  => Hash::make('qwer'),
            ],
            [
                'name'      => 'zxcv',
                'email'     => 'zxcv@zxcv.zxcv',
                'password'  => Hash::make('zxcv'),
            ],
            [
                'name'      => 'uiop',
                'email'     => 'uiop@uiop.uiop',
                'password'  => Hash::make('uiop'),
            ],
            [
                'name'      => 'hjkl',
                'email'     => 'hjkl@hjkl.hjkl',
                'password'  => Hash::make('hjkl'),
            ],

        ];

        
        for ($i = 0; $i < 5; $i++) {
            $User = new User();

            $User->name = $users[$i]['name'];
            $User->lastname = $faker->lastName();
            $User->email = $users[$i]['email'];
            $User->address = $faker->streetAddress();
            $User->passowrd = Hash::make($users[$i]['name']);
            $User->phone_number = $faker->phoneNumber();
            $User->city = $faker->city();
            $User->postal_code = $faker->postcode();
            $User->cv = $faker->paragraphs(3);
            $User->service = $faker->word();
            // $User->photo = $faker->streetAddress();
        }
    }
}
