<?php

namespace Tests\Feature\Api\Pub;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutTest extends TestCase
{

    use DatabaseMigrations, RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testApplyCoupon(): void
    {
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];

        $coupon = Coupon::factory()->create();
        $data = [
            'code' => $coupon['code'],
        ];

        $this->assertDatabaseHas('coupons', [
            'code' => $data['code'],
        ]);

        $response = $this
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])
            ->post('/api/applyCoupon', $data);

        $response->assertOk();
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'errors',
            'data',
        ])->assertJson([
            'status' => true,
            'errors' => [],
        ]);

        $response->assertCookie('Coupon');
    }
}
