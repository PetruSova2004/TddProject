<?php

namespace Tests\Feature\Api\Pub;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testReceiving(): void
    {
        Category::factory()->create();
        $response = $this->get('/api/categoryAll');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'errors',
                'data' => [
                    'categories' => [
                        '*' => [
                            'id',
                            'title',
                            'image_path',
                        ]
                    ]
                ]
            ]);
//        '*' указывает, что в массиве categories может быть любое количество элементов, и каждый из этих элементов должен содержать поля id и title.

        $response->assertJson([
            'status' => true,
            'errors' => [],
        ]);

    }

    public function testBadReceiving(): void
    {
        $response = $this->get('/api/categoryAll');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'errors',
            'data',
        ]);

        $this->assertNotEmpty($response['errors']);
    }

}
