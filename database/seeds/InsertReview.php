<?php

use App\Models\ProductVendor;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class InsertReview extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereRole(1)->first();

        ProductVendor::inRandomOrder()->take(2)->get()->each(function ($item) use ($user) {
            $review = new Review();
            $review->body = 'bagus bagus';
            $review->user_id = $user->id;
            $review->product_vendor_id = $item->id;
            $review->rating = rand(4, 5);
            $review->save();
        });
    }
}
