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

class CartTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
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

        $user = factory(User::class)->create();

        $this->actingAs($user, 'api');


        $this->assertCount(0, $user->Cart); // Asssert user;s cart i null

        $data = [
            "product_id"    =>  $product->id,
            "vendor_id"     =>  $vendor->id,
            "quantity"      =>  2
        ];

        $response = $this->json('POST', '/api/cart', $data);

        dd($response);
    }
}
