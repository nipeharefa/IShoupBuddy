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

    private $user;
    private $category;
    private $product;
    private $vendor;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->seed('InsertDefaultCategory');
        $this->generateCart();
    }


    public function testAddItemToCart()
    {
        $this->actingAs($this->user, 'api');

        $data  = [
            'product_vendor_id' =>  $this->productVendor->id,
            'quantity'          =>  3
        ];

        $response = $this->json("POST", "api/cart", $data);

        Log::info($response->getContent());
        $this->assertTrue(true);
    }

    public function generateCart() {

        $this->category = Category::first();
        $this->vendor = factory(Vendor::class)->create();

        $this->product = factory(Product::class)->create([
            "category_id"   =>  $this->category->id
        ]);

        $this->productVendor = $this->vendor->ProductVendor()
            ->save(factory(ProductVendor::class)->create([
                "product_id"    =>  $this->product->id,
                "vendor_id"     =>  $this->vendor->id
            ]));

        $this->user = factory(User::class)->create();
    }
}
