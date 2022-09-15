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
                'password'  => 'asdf',
            ],
            [
                'name'      => 'qwer',
                'email'     => 'qwer@qwer.qwer',
                'password'  => 'qwer',
            ],
            [
                'name'      => 'zxcv',
                'email'     => 'zxcv@zxcv.zxcv',
                'password'  => 'zxcv',
            ],
            [
                'name'      => 'uiop',
                'email'     => 'uiop@uiop.uiop',
                'password'  => 'uiop'
            ],
            [
                'name'      => 'hjkl',
                'email'     => 'hjkl@hjkl.hjkl',
                'password'  => 'hjkl',
            ],

        ];

        
        for ($i = 0; $i < 5; $i++) {
            $user = new User();

            $user->name = $users[$i]['name'];
            $user->lastname = $faker->lastName();
            $user->email = $users[$i]['email'];
            $user->address = $faker->streetAddress();
            $user->password = Hash::make($users[$i]['password']);
            $user->phone = $faker->phoneNumber();
            $user->city = $faker->city();
            $user->postal_code = (int)$faker->postcode();
            $user->cv = implode($faker->paragraphs(3));
            $user->service = $faker->word();
            // $User->photo = $faker->streetAddress();
            $user->save();
        }
    }
}
