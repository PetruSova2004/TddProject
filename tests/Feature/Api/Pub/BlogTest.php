<?php

namespace Tests\Feature\Api\Pub;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;
    /**
     * A basic feature test example.
     */

    public function testUnauthorizedRequest(): void
    {
        User::factory()->count(5)->create();
        Category::factory()->count(5)->create();
        Blog::factory()->count(10)->create();

        $response = $this->get('/api/blogs');
        $response->assertStatus(404);
    }

    public function testGetBlogs(): void
    {
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];

        Category::factory()->count(5)->create();
        Blog::factory()->count(10)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/blogs');

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
    }

    public function testGetBlogDetails()
    {
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];

        Category::factory()->count(5)->create();
        $blog = Blog::factory()->create();


        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("/api/blog?id=" . $blog->id);

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
    }

}
