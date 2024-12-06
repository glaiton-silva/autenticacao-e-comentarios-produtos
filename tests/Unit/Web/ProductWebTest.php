<?php

namespace Tests\Unit\Web;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Comment;
use App\Models\Product;

class ProductWebTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_view_product_page()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.show', ['id' => $product->id]));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }
}
