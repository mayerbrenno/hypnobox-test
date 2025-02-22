<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {

        $this->post('api/register', [
            'name' => 'Test User',
            'email' => 'test@example',
            'password' => 'password',
        ])->assertStatus(201);
    }
}
