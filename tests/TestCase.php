<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function login(): TestResponse
    {
        $user = $this->getUser();
        $guestToken = $this->getGuestToken();
        $data = [
            'email' => $user->email,
            'password' => 'password123',
        ];

        return $this->withHeaders([
            'guestToken' => $guestToken,
        ])->post('/api/login', $data);
    }

    public function getGuestToken()
    {
        $response = $this->post('/api/generateToken');

        return $response['data']['token'];
    }

    public function getUser(): User
    {
        DB::table('oauth_clients')->insert([
            'user_id' => null,
            'name' => 'Laravel Personal Access Client',
            'secret' => 'cCrOjCBmZYDqilaYa1qNvJ6WNnckKJDem6AeD6to',
            'redirect' => 'http://localhost',
            'personal_access_client' => 1,
            'password_client' => 0,
            'revoked' => 0,
        ]);

        $authClient = DB::table('oauth_clients')->first();

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $authClient->id,
        ]);

        return User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);
    }

}
