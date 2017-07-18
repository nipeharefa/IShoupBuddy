<?php

use App\Models\Vendor;
use App\Models\ProductVendor;
use App\Models\Product;
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
        DB::statement('SET foreign_key_checks=0');
        ProductVendor::truncate();
        DB::statement('SET foreign_key_checks=1');

        $vendor = factory(Vendor::class)->create();

        Product::get()->each(function($item) use ($vendor) {
            $data = [
                'product_id'    =>  $item->id,
                'harga'         =>  rand(1000, 9999),
                'status'        =>  1,
                'vendor_id'     =>  $vendor->id
            ];
            ProductVendor::create($data);
        });
    }
}
