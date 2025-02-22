<?php

namespace Tests\Feature;

use App\Models\Produto;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProdutoTest extends TestCase
{
    use InteractsWithContainer;
    use RefreshDatabase;

    public function testCreateProduto()
    {
        $this->post('api/categorias', [
            'name' => 'rural',
            'active' => true
        ]);

        $response = $this->post('api/produtos', [
            'name' => 'Apartamento Studio',
            'description' => 'Apartamento Studio',
            'price' => 1100000,
            'category_id' => 1
        ]);

        $response->assertStatus(201);
    }

    public function testListProduto()
    {
        $response = $this->get('api/produtos');

        $response->assertStatus(201);
    }
}
