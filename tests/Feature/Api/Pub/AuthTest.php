<?php

namespace Tests\Feature\Api\Pub;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseMigrations, WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     */

    public function testRegistration(): void
    {
        DB::table('oauth_clients')->insert([
            'user_id' => null,
            'name' => 'Laravel Personal Access Client',
            'secret' => 'cCrOjCBmZYDqilaYa1qNvJ6WNnckKJDem6AeD6to',
            'redirect' => 'http://127.0.0.1:8001/',
            'personal_access_client' => 1,
            'password_client' => 0,
            'revoked' => 0,
        ]);

        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
        ];

        $this->assertDatabaseMissing('users', [
            'email' => $userData['email'],
        ]);

        $response = $this->post('/api/registration', $userData);

        $response->assertStatus(200)->assertJson([
            'status' => true,
        ])->assertJsonStructure([
            'status',
            'data' => [
                'token'
            ],
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);


    }

    public function testBadRegistration(): void
    {
        $userData = [
            'name' => 'Name',
            'email' => 'InvalidEmail',
            'password' => 'short',
        ];

        $response = $this->post('/api/registration', $userData);

        $response->assertStatus(400);

        $response->assertJson([
            'status' => false,
        ])->assertJsonStructure(['status', 'errors']);
    }

    public function testLoginAndLogout(): void
    {
        $user = $this->getUser();

        $data = [
            'email' => $user->email,
            'password' => 'password123',
        ];

        $response = $this->post('/api/login', $data);

        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json()['data']);

        // Test that cookie has been created
        $response->assertCookie('Token');

        // Test other route which requires token`
        $token = $response->json()['data']['token'];

        $testAuthRoute = $this->withHeaders(['Authorization' => 'Bearer ' . $token,])->get('/api/user');
        $testAuthRoute->assertStatus(200);


        // Test deleting token(Logout)
        $user->tokens()->delete();
        $this->assertEquals(0, $user->tokens()->count());
    }

    public function testBadLogin(): void
    {
        $data = [
            'email' => 'BadMail',
            'password' => 'short'
        ];

        $response = $this->post('/api/login', $data);

        $response->assertStatus(400);
        $response->assertJsonStructure([
            'status',
            'errors',
        ]);

        $testAuthBadRoute = $this->withHeaders(['Authorization' => 'Bearer ' . 'Bad Token',])->get('/api/user');
        $testAuthBadRoute->assertStatus(500);
    }


}
