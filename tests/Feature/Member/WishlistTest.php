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
use Log;

class WishlistTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();
        $vendor = factory(Vendor::class)->create();

        $product = factory(Product::class)->create([
            "category_id"   =>  $category->id
        ]);

        $data = [
            "product_id"    =>  $product->id
        ];

        $this->actingAs($user, 'api');

        $response = $this->json('POST', 'api/wishlist', $data);
        $response->assertStatus(201);

        $this->assertTrue($user->wished($product->id));
    }
}
