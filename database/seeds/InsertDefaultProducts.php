<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Faker\Factory as Faker;

class InsertDefaultProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $category = Category::first();

        $dat = Storage::get('init-products.json');
        $data = json_decode($dat, true);

        DB::statement("SET foreign_key_checks=0");
        Product::truncate();
        DB::statement("SET foreign_key_checks=1");

        $beforeProduct = collect($data)->map(function ($item) use ($category, $faker) {
            return [
                "name"  =>  $item["name"],
                "category_id"   =>  $category->id,
                "barcode"       =>  $item['barcode'] ?? $faker->ean13,
                "slug"          =>  str_slug($item['name']),
                "picture_url"   =>  $item['picture_url'],
                "description"   =>  $faker->realText
            ];
        });


        foreach ($beforeProduct->toArray() as $key => $value) {
            Product::create($value);
        }

        $this->command->info('Success');
    }
}
