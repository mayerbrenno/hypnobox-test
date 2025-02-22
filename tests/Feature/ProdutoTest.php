<?php

namespace Tests\Feature;

use App\Models\Produto;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProdutoTest extends TestCase
{
    use InteractsWithContainer;
    use RefreshDatabase;

    public function test_user_can_list_products()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('api/login', [
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertStatus(200);

        $this->assertAuthenticated();

        $response = $this->actingAs($user)->get('api/produtos');

        $response->assertStatus(201);
    }

    public function test_user_can_create_a_product()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('api/login', [
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertStatus(200);

        $this->assertAuthenticated();

        $responseCategory = $this->actingAs($user)->post('api/categorias', [
            'name' => 'rural',
            'active' => true
        ]);

        $categoryId = $responseCategory->json()['id'];

        $response = $this->actingAs($user)
            ->post('/api/produtos', [
                'name' => 'Produto 1',
                'description' => 'Descrição do produto 1',
                'price' => 900000,
                'category_id' => $categoryId
            ]);

        $response->assertStatus(201);
    }


}
