<?php

namespace Tests\Feature\Api\Pub;

use App\Mail\WelcomeEmail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CheckoutTest extends TestCase
{

    use DatabaseMigrations, RefreshDatabase;

    /**
     * A basic feature test example.
     */

    public function testPlaceOrder(): void
    {
        $this->withoutExceptionHandling();
        $loginResponse = $this->login();
        $token = $loginResponse['data']['token'];
        $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();

        Category::factory()->count(5)->create();
        Product::factory()->count(15)->create();
        Cart::factory()->create();

        $countrySeeder = "CountrySeeder";
        Artisan::call('db:seed', ['--class' => $countrySeeder]);
        $country = Country::query()->first();

        $data = [
            'user_id' => $user->id,
            'firstname' => $user->name,
            'lastname' => 'Test',
            'email' => $user->email,
            'phone' => "+37367594703",
            'price' => 4862,
            'country' => $country->name,
            'address' => 'Test address',
            'city' => 'Chicago',
            'zip' => $country->zip,
            'ordered_products' => json_encode([
                [
                    'product_name' => 'Product A',
                    'quantity' => 2,
                    'price' => 10.99,
                ],
                [
                    'product_name' => 'Product B',
                    'quantity' => 7,
                    'price' => 150.99,
                ],
            ]),
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/placeOrder', $data);
        $response->assertOk();

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'errors',
                'data',
            ])
            ->assertJson([
                'status' => true,
                'errors' => [],
            ]);
    }

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
            'user_id' => $user->getAuthIdentifier(),
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
        ])->assertJson([
            'status' => false,
        ]);

        $count = DB::table('coupon_user')
            ->where('user_id', $user->getAuthIdentifier())
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

        DB::table('coupon_user')->insert([
            'coupon_id' => $coupon->id,
            'user_id' => $user->getAuthIdentifier(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $query = DB::table('coupon_user')
            ->where('user_id', $user->getAuthIdentifier())
            ->where('coupon_id', $coupon->id);
        $user_coupon = $query->first();

        if ($user_coupon) {
            $currentCreatedAt = $user_coupon->created_at;
            $newCreatedAt = Carbon::parse($currentCreatedAt)->addHours(7);
            $query->update([
                'created_at' => $newCreatedAt,
                'updated_at' => $newCreatedAt,
            ]);
        }

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
            'user_id' => $user->getAuthIdentifier(),
        ]);

    }

}
