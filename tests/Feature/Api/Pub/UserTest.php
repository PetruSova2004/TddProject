<?php

namespace Tests\Feature\Api\Pub;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use function Symfony\Component\String\u;

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

    public function testUpdateProfileMethod(): void
    {
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];

        $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();

        $data = [
            'name' => 'NewName',
            'email' => 'newemail@mail.com',
            'password' => 'newPassword144',
            'password_confirmation' => 'newPassword144',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->patch('/api/updateProfile', $data);
        $response->assertOk();

        $response->assertJsonStructure([
            'status',
            'errors',
            'data',
        ])->assertJson([
            'status' => true,
            'errors' => [],
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $data['name'],
        ]);
    }

}
