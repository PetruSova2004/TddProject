<?php

namespace Tests\Feature\Api\Pub;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{

    use DatabaseMigrations, RefreshDatabase;


    public function testCartGet(): void
    {
        Category::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];
        Cart::factory()->count(10)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/getCart');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'errors',
                'data' => [
                    'cart'
                ]
            ])->assertJson([
                'status' => true,
                'errors' => [],
            ]);
    }

    public function testCartAdd(): void
    {
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];

        Category::factory()->count(10)->create();
        $product = Product::factory()->create();

        $data = [
            'productId' => $product->id,
            'quantity' => 1,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/cart/add', $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'errors',
                'data' => [
                    'message',
                    'cart' => [
                        '*' => [
                            'product_id',
                            'quantity',
                        ]
                    ],
                ]
            ])->assertJson([
                'status' => true,
                'errors' => [],
                'data' => [
                    'message' => 'Product has been added to cart successfully',
                ]
            ]);

        // Проверяем если можем получить товары пользователя
        $getResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/getCart');

        $getResponse->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'errors',
                'data' => [
                    'cart'
                ]
            ])->assertJson([
                'status' => true,
                'errors' => [],
            ]);

    }

    public function testCartDelete(): void
    {
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];

        Category::factory()->count(10)->create();
        Product::factory()->count(10)->create();

        $cart = Cart::factory()->create();

        $data = [
            'productId' => $cart->product_id,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/cart/delete', $data);

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

        $this->assertDatabaseMissing('carts', [
            'id' => $cart->id
        ]);
    }

}
