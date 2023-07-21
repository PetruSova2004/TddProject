<?php

namespace Tests\Feature\Api\Pub;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testReceiving(): void
    {
        Category::factory()->count(10)->create();
        Product::factory()->count(25)->create();

        $response = $this->get('/api/getProducts');

        $response->assertStatus(200)->assertJsonStructure([
            'status',
            'errors',
            'data' => [
                'products' => [
                    '*' => [
                        'id',
                        'title',
                        'image_path',
                        'description',
                        'views',
                        'category_title',
                    ]
                ]
            ]
        ]);

        $response->assertJson([
            'status' => true,
            'errors' => [],
            'data' => [
                'products' => []
            ]
        ]);
    }

    public function testBadReceiving(): void
    {
        $response = $this->get('/api/getProducts');
        $response->assertStatus(400)->assertJsonStructure([
            'status',
            'errors',
            'data',
        ]);

        $response->assertJson([
            'status' => false,
            'errors' => [],
        ]);
        $this->assertNotEmpty($response['errors']);
    }

    public function testShowProduct(): void
    {
        Category::factory()->count(10)->create();

        $product = Product::factory()->create();

        $response = $this->get("/api/getProduct?id={$product->id}");

        $response->assertStatus(200)->assertJsonStructure([
            'status',
            'errors',
            'data' => [
                'product' => [
                    'id',
                    'title',
                    'price',
                    'image_path',
                    'description',
                    'views',
                    'category_title',
                ]
            ],
        ]);

        $response->assertJson([
            'status' => true,
            'errors' => [],
        ]);

        $this->assertEmpty($response['errors']);
    }

    public function testBadReceivingProduct(): void
    {
        $response = $this->get('/api/getProduct');
        $response->assertStatus(400);
        $response->assertJsonStructure([
            'status',
            'errors',
            'data',
        ]);
        $response->assertJson([
            'status' => false,
        ]);

        $this->assertNotEmpty($response['errors']);
    }

}
