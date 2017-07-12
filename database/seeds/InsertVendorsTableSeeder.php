<?php

use App\Models\Vendor;
use Illuminate\Database\Seeder;

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
