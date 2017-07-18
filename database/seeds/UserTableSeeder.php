<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET foreign_key_checks=0');
        User::truncate();
        DB::statement('SET foreign_key_checks=1');
        factory(User::class)->create();
    }
}
