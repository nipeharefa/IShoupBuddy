<?php

namespace Tests\Feature\Member;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\ProductVendor;
use App\Models\Review;

class ReviewTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_delete_review() {

        $category = factory(Category::class)->create();
        $vendor = factory(Vendor::class)->create();

        $product = factory(Product::class)->create([
            "category_id"   =>  $category->id
        ]);

        $product_vendor = $vendor->ProductVendor()
            ->save(factory(ProductVendor::class)->create([
                "product_id"    =>  $product->id,
                "vendor_id"     =>  $vendor->id
            ]));

        // Create Dummy Review


        $user = factory(User::class)->create();

        $review = $user->Review()
            ->save(factory(Review::class)->create([
                'product_vendor_id' =>  $product_vendor->id,
                "user_id"           =>  $user->id
            ]));

        $this->assertCount(1, Review::get()); // make sure review saved
        $this->assertCount(1, $user->Review); // make sure user's review saved

        $this->actingAs($user, 'api');

        $response = $this->json("DELETE", "/api/review/{$review->id}");

        $response->assertStatus(204);

        $this->assertCount(0, Review::get());
        $this->assertCount(1, Category::get());
    }
}
