<?php

namespace Tests;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function login(): TestResponse
    {
        $user = $this->getUser();
        $data = [
            'email' => $user->email,
            'password' => 'password123',
        ];

        return  $this->post('/api/login', $data);
    }

    public function getUser(): User
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

        return User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);
    }

}
