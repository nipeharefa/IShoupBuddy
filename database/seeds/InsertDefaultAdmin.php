<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\User;

class InsertDefaultAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $admin =  [
            'name'              =>  "Administrator",
            'email'             =>  $faker->unique()->safeEmail,
            'password'          =>  bcrypt('secret'),
            'remember_token'    =>  str_random(10),
            'role'              =>  0,
            'latitude'          =>  $faker->latitude,
            'longitude'         =>  $faker->longitude
        ];

        User::create($admin);
    }
}
