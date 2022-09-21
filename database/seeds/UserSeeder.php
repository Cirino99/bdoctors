<?php

use Faker\Factory;
use App\Models\User;
use Illuminate\Http\File;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        $faker = Factory::create('it_IT');
        for ($i = 0; $i < 20; $i++) {
            $user = new User();

            $user->name = $faker->firstName();
            $user->lastname = $faker->lastName();
            $user->email = $faker->freeEmail();
            $user->address = $faker->streetAddress();
            $user->password = Hash::make('asdf');
            $user->phone = $faker->phoneNumber();
            $user->city = $faker->city();
            $user->postal_code = (int)$faker->postcode();
            $user->cv = implode($faker->paragraphs(3));
            $user->service = $faker->word();
            // $User->photo = $faker->streetAddress();
            $contents = new File(__DIR__ . '/../../storage/app/img/'. rand(1, 13) . '.jpg');
                $user->photo = Storage::put('uploads', $contents);
            $user->save();
        }
    }
}
