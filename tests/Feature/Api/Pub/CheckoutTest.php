<?php

namespace Tests\Feature\Api\Pub;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $user = Auth::user();

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

        $this->assertDatabaseHas('coupon_user', [
            'coupon_id' => $coupon->id,
            'user_id' => $user->id,
        ]);

        // Trying to add one more same coupon for our user
        $secondCouponResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/applyCoupon', $data);

        $secondCouponResponse->assertStatus(400);
        $secondCouponResponse->assertJsonStructure([
            'status',
            'errors',
            'data',
        ])
            ->assertJson([
                'status' => false,
            ]);

        $count = DB::table('coupon_user')
            ->where('user_id', $user->id)
            ->where('coupon_id', $coupon->id)
            ->count();

        $this->assertEquals(1, $count);
    }

    public function testDeleteCoupon(): void
    {
        $this->withoutExceptionHandling();
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];
        $user = Auth::user();

        $coupon = Coupon::factory()->create();
        $coupon->created_at = Carbon::parse($coupon->created_at)->addHours(6);
        $coupon->save();

        DB::table('coupon_user')->insert([
            'coupon_id' => $coupon->id,
            'user_id' => $user->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $data = [
            'code' => $coupon['code'],
        ];
        $this->assertDatabaseHas('coupons', [
            'code' => $data['code'],
        ]);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/deleteCoupon', $data);
        $response->assertOk();

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'errors',
                'data',
            ])->assertJson([
                'status' => true,
                'errors' => [],
            ]);

        $this->assertDatabaseMissing('coupon_user', [
            'user_id' => $user->id,
        ]);

    }

}
