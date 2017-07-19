<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'password'          => $password ?: $password = bcrypt('secret'),
        'remember_token'    => str_random(10),
        'role'              => 1,
        'picture_url'       => 'skripsi-gilfoyle.jpg'
    ];
});

$factory->define(App\Models\Vendor::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'                    => $faker->name,
        'email'                   => $faker->unique()->safeEmail,
        'password'                => $password ?: $password = bcrypt('secret'),
        'remember_token'          => str_random(10),
        'role'                    => 2,
        'latitude'                => $faker->latitude,
        'longitude'               => $faker->longitude,
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->unique()->safeEmail,
        'slug'        => $faker->slug,
    ];
});

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    static $user_id;
    static $category_id;

    return [
        'name'          => $faker->name,
        'category_id'   => $category_id,
        'slug'          => $faker->slug,
        'description'   => $faker->text,
        'barcode'       => $faker->isbn13,
        'picture_url'   => 'lorem.png',
    ];
});

$factory->define(App\Models\Review::class, function (Faker\Generator $faker) {
    return [
        'rating'    => $faker->randomFloat(null, 1, 4),
        'body'      => 'bagus bagus',
    ];
});

$factory->define(App\Models\ProductVendor::class, function (Faker\Generator $faker) {
    static $vendor_id;
    static $product_id;

    return [
        'vendor_id'     => $vendor_id,
        'product_id'    => $product_id,
        'harga'         => 10000,
        'status'        => 0,
    ];
});
