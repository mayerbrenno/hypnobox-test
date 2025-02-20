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
				// $response = $this->post('api/produtos', [
				// 		'name' => 'Apartamento Studio',
				// 		'description' => 'Apartamento Studio',
				// 		'price' => 1100000,
				// 		'category_id' => 1,
				// 		'created_by' => 1
				// ]);

				$responseCategory = $this->post('api/categorias', [
					'name' => 'rural',
					'active' => true
				]);

				$response = $this->post('/api/produtos', [
					'name' => 'Produto 1',
					'description' => 'Descrição do produto 1',
					'price' => 10.99,
					'category_id' => 1
				]);

				// $response = $this->postJson('api/produtos');


        // $produto = new Produto();
        // $produto->name = 'Test Produto';
        // $produto->description = 'Test Description';
        // $produto->price = 10.99;
        // $produto->category_id = 1;

				$response->assertStatus(201);

        // $this->assertTrue($produto->save());
        // $this->assertNotNull($produto->id);
    }

		public function testListProduto()
    {
				$response = $this->get('api/produtos');

				$response->assertStatus(201);
    }
}
