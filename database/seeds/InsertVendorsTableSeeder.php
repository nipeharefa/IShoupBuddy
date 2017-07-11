<?php

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class InsertVendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = $this->command->ask('Jumlah vendor');
        factory(Vendor::class)->create();
    }
}
