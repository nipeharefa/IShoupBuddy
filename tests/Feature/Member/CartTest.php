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


    public function testExample()
    {
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

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');
        $this->assertCount(0, $user->Cart); // Asssert user;s cart i null

        $data = [
            "product_id"    =>  $product->id,
            "vendor_id"     =>  $vendor->id,
            "quantity"      =>  2
        ];

        $response = $this->json('POST', 'api/cart', $data);
        $response->assertStatus(201);

        $this->assertCount(1, Cart::get());
    }

    public function test_get_item_form_cart() {

        $this->generateCart();

        $this->assertCount(1, Category::get());

        $user = User::find(2);

        $response = $this->json('GET', 'api/cart', []);

        $response->assertStatus(200);
        $response->assertJson([
            "data"      =>  "OK",
            "message"   =>  null,
            "carts"     =>  [
                "total" =>  20000
            ]
        ]);
    }

    public function test_guest_get_item_from_cart() {

        $response = $this->json('GET', 'api/cart', []);
        $response->assertStatus(401);
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
