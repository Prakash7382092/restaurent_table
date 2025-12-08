<?php

namespace Tests\Feature\Addresses;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_crud_their_addresses()
    {
        // ensure the user has the customer role so role:customer middleware passes
        $user = User::factory()->create(['role' => 'customer']);
        Sanctum::actingAs($user, ['*']);

        // Create
        $response = $this->postJson('/api/addresses', [
            'address_line_1' => '100 A St',
            'city' => 'Lahore',
            'state' => 'Punjab',
            'zip_code' => '54000',
            'country' => 'PK',
            'is_default' => true,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.user_id', $user->id)
            ->assertJsonPath('data.is_default', true);

        $addressId = $response->json('data.id');

        // Index (should only contain user's addresses)
        $index = $this->getJson('/api/addresses');
        $index->assertStatus(200)
            ->assertJsonPath('data.0.id', $addressId);

        // Show
        $show = $this->getJson("/api/addresses/{$addressId}");
        $show->assertStatus(200)
            ->assertJsonPath('data.id', $addressId);

        // Update (partial update allowed)
        $update = $this->putJson("/api/addresses/{$addressId}", [
            'address_line_1' => '200 B Ave',
            'city' => 'Karachi',
        ]);
        $update->assertStatus(200)
            ->assertJsonPath('data.address_line_1', '200 B Ave')
            ->assertJsonPath('data.city', 'Karachi');

        // Delete - controller returns JSON message (200)
        $delete = $this->deleteJson("/api/addresses/{$addressId}");
        $delete->assertStatus(200)
            ->assertJson(['message' => 'Address deleted.']);

        $this->assertDatabaseMissing('addresses', ['id' => $addressId]);
    }

    public function test_cannot_view_others_address()
    {
        $user = User::factory()->create(['role' => 'customer']);
        $other = User::factory()->create(['role' => 'customer']);

        $address = Address::factory()->create(['user_id' => $other->id]);

        Sanctum::actingAs($user, ['*']);
        $response = $this->getJson("/api/addresses/{$address->id}");
        $response->assertStatus(403);
    }
}
