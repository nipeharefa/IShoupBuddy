<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InsertDefaultCategory::class);
        $this->call(UserTableSeeder::class);
        $this->call(InsertDefaultProducts::class);
        $this->call(InsertDefaultAdmin::class);
        $this->call(InsertVendorsTableSeeder::class);
    }
}
