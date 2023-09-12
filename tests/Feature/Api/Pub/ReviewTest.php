<?php

namespace Tests\Feature\Api\Pub;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testGoodReviewApply(): void
    {
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];

        $email = $loginResponse['data']['user']['email'];

        Category::factory()->count(5)->create();
        Product::factory()->count(10)->create();
        $product = Product::query()->inRandomOrder()->first();
        $data = [
            'comment' => 'Some comment for review',
            'product_id' => $product->id,
            'email' => $email,
            'rating' => rand(1, 5),
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/applyReview', $data);
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

        $this->assertDatabaseHas('reviews', [
            'product_id' => $data['product_id'],
            'email' => $data['email'],
            'comment' => $data['comment'],
        ]);
    }

    public function testBadReviewApply()
    {
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];

        Category::factory()->count(5)->create();
        Product::factory()->count(10)->create();
        $data = [
            'comment' => 'Some comment for review',
            'product_id' => '745',
            'email' => 'differentEmail@mail.ru',
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/applyReview', $data);
        $response->assertStatus(422); // валидация не прошла
    }

    public function testGetProductReviews()
    {
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];

        Category::factory()->count(5)->create();
        Product::factory()->count(10)->create();
        Review::factory()->count(15)->create();

        $product = Product::query()->inRandomOrder()->first();
        $data = [
            'product_id' => $product->id
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/getProductReviews?' . http_build_query($data));
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

    }

}
