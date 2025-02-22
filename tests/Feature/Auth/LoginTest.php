<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test__users_can_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('api/login', [
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertStatus(200);

        $this->assertAuthenticated();
    }
}
