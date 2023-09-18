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
    public function testAddAndClearWishlist(): void
    {
        Category::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        $product = Product::query()->inRandomOrder()->first();

        $data = [
            'productId' => $product->id,
        ];

        $guestToken = $this->getGuestToken();
        // add product into wishlist
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

        $clearResponse = $this->withHeaders([
            'guestToken' => $guestToken,
        ])->delete('/api/clearWishlist');

        $clearResponse->assertOk();
        $clearResponse->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'errors',
                'data',
            ])
            ->assertJson([
                'status' => true,
                'errors' => [],
            ]);
        $this->assertNull(Cache::get('wishlist'));
    }

    public function testDeleteOneProduct(): void
    {
        Category::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        $product = Product::query()->inRandomOrder()->first();

        $data = [
            'productId' => $product->id,
        ];
        $guestToken = $this->getGuestToken();

        for ($i = 0; $i <= 4; $i++) { // Добавляем больше товаров в wishlist
            $this->withHeaders([
                'guestToken' => $guestToken,
            ])->post('/api/addToWishlist', $data);
            $data['productId']++;
        }

        $response = $this->withHeaders([
            'guestToken' => $guestToken,
        ])->delete('/api/deleteProductFromWishlist', $data);
        $response->assertOk();

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'errors',
                'data',
            ])
            ->assertJson([
                'status' => true,
                'errors' => [],
            ]);

        $cache = Cache::get('wishlist');
        foreach ($cache as $item) {
            $this->assertFalse($item['id'] === $data['productId']);
        }
    }
}
