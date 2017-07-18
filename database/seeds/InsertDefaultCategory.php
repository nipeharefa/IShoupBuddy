<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

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
            'name'      => 'Uncategorized',
            'slug'      => str_slug('Uncategorized'),
        ];

        DB::statement('SET foreign_key_checks=0');
        Category::create($data);
        DB::statement('SET foreign_key_checks=1');

    }
}
