<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_customer_creates_user_and_returns_token()
    {
        $payload = [
            'name' => 'Test Customer',
            'email' => 'customer@example.test',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson(route('auth.register.customer'), $payload);

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'user', 'token']);

        $this->assertDatabaseHas('users', [
            'email' => 'customer@example.test',
            'role' => 'customer',
        ]);
    }

    public function test_register_vendor_creates_user_and_vendor_and_returns_token()
    {
        $payload = [
            'name' => 'Test Vendor',
            'email' => 'vendor@example.test',
            'password' => 'password',
            'password_confirmation' => 'password',
            'store_name' => 'Vendor Store',
        ];

        $response = $this->postJson(route('auth.register.vendor'), $payload);

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'user', 'token']);

        $this->assertDatabaseHas('users', [
            'email' => 'vendor@example.test',
            'role' => 'vendor',
        ]);

        $user = User::where('email', 'vendor@example.test')->first();

        $this->assertDatabaseHas('vendors', [
            'user_id' => $user->id,
            'store_name' => 'Vendor Store',
        ]);
    }

    public function test_login_returns_token_and_user()
    {
        $user = User::factory()->create([
            'email' => 'login@example.test',
            'password' => 'password',
            'role' => 'customer',
            'status' => 'active',
        ]);

        $response = $this->postJson(route('auth.login'), [
            'email' => 'login@example.test',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['message', 'user', 'token']);
    }

    public function test_me_and_logout_require_auth()
    {
        $user = User::factory()->create([
            'password' => 'password',
            'role' => 'customer',
            'status' => 'active',
        ]);

        Sanctum::actingAs($user);

        $meResponse = $this->getJson(route('auth.me'));
        $meResponse->assertStatus(200)->assertJsonFragment(['email' => $user->email]);

        $logoutResponse = $this->postJson(route('auth.logout'));
        $logoutResponse->assertStatus(200)->assertJson(['message' => 'Logged out successfully']);
    }
}
