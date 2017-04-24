<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class InsertDefaultProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::first();

        $dat = Storage::get('init-products.json');
        $data = json_decode($dat, true);


        $beforeProduct = collect($data)->map(function($item) use($category) {

            return [
                "name"  =>  $item["name"],
                "category_id"   =>  $category->id,
                "barcode"       =>  $item['barcode'],
                "slug"          =>  str_slug($item['name']),
                "picture_url"   =>  $item['picture_url'],
                "description"   =>  "-"
            ];
        });


        foreach ($beforeProduct->toArray() as $key => $value) {

            Product::create($value);
        }

        $this->command->info('Success');
    }
}
