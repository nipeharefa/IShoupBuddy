<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class InsertDefaultCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "name"      =>  "Uncategorized",
            "slug"      => str_slug("Uncategorized")
        ];

        Category::create($data);
    }
}
