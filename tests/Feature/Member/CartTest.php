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
use App\Models\Cart;
use Log;

class CartTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->seed('InsertDefaultCategory');
    }


    public function testAddItemToCart()
    {
        $this->assertTrue(true);
    }

    public function generateCart() {

        $category = Category::first();
        $vendor = factory(Vendor::class)->create();

        $product = factory(Product::class)->create([
            "category_id"   =>  $category->id
        ]);

        $product_vendor = $vendor->ProductVendor()
            ->save(factory(ProductVendor::class)->create([
                "product_id"    =>  $product->id,
                "vendor_id"     =>  $vendor->id
            ]));

        $data = [
            "product_id"    =>  $product->id,
            "vendor_id"     =>  $vendor->id,
            "quantity"      =>  2
        ];

        $user = factory(User::class)->create();

        $this->actingAs($user, 'api');
        $data = [
            "product_id"    =>  $product->id,
            "vendor_id"     =>  $vendor->id,
            "quantity"      =>  2
        ];

        $this->json('POST', 'api/cart', $data);
    }
}
