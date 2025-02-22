<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationSanctumTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('api/produtos')
            ->assertStatus(201);

        $this->assertAuthenticated();
    }
}
