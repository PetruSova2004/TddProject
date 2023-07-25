<?php

namespace Tests\Feature\Api\Pub;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase, DatabaseMigrations;

    /**
     * A basic feature test example.
     */
    public function testGetUserByTokenMethod(): void
    {
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/getUser');

        $response->assertOk()
        ->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'errors',
            'data' => [
                'message',
                'email',
            ]
        ]);

        $response->assertJson([
            'status' => true,
            'errors' => [],
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $response['data']['email'],
        ]);


    }
}
