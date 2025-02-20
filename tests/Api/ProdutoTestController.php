<?php

namespace Tests\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutoTestController extends TestCase
{
    public function testGetProdutos()
    {
        // Send a GET request to the API endpoint
        $response = $this->get('/api/produtos');

        // Verify the response status code
        $response->assertStatus(200);

        // Verify the response body
        // $response->assertJson([
        //     'data' => [
        //         // ...
        //     ],
        // ]);
    }

    public function testCreateProduto()
    {
        // Send a POST request to the API endpoint
        $response = $this->post('/api/produtos', [
            'name' => 'Apartamento Studio',
            'description' => 'Apartamento Studio',
						'price' => 1100000,
						'category_id' => 1,
						'created_by' => 1
        ]);

        // Verify the response status code
        $response->assertStatus(201);

        // Verify the response body
        // $response->assertJson([
        //     'data' => [
        //         // ...
        //     ],
        // ]);
    }
}
