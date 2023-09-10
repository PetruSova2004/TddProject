<?php

namespace Tests\Feature\Api\Pub;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseMigrations, WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     */

    public function testRegistration(): void
    {
        $this->getUser();
        $password = Str::random(7);

        $userData = [
            'name' => "MoreThan4CharactersName",
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'phone' => '+3212456578',
            'password' => $password,
            'password_confirmation' => $password,
        ];

        $this->assertDatabaseMissing('users', [
            'email' => $userData['email'],
        ]);

        $guestToken = $this->getGuestToken();

        $response = $this->withHeaders([
            'guestToken' => $guestToken,
        ])->post('/api/registration', $userData);

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

        $guestToken = $this->getGuestToken();

        $response = $this->withHeaders([
            'guestToken' => $guestToken,
        ])->post('/api/login', $data);

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
    }


}
