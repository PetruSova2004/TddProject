<?php

namespace Tests\Feature\Api\Pub;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class WishlistTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testAddToWishlist(): void
    {
        Category::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        $product = Product::query()->inRandomOrder()->first();

        $data = [
            'productId' => $product->id,
        ];

        $guestToken = $this->getGuestToken();
        $response = $this->withHeaders([
            'guestToken' => $guestToken,
        ])->post('/api/addToWishlist', $data);
        $response->assertOk();

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'errors',
                'data',
            ])->assertJson([
                'status' => true,
                'errors' => [],
            ]);
        $this->assertTrue(Cache::has('wishlist'));
    }
}
