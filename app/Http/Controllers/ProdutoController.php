<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return new JsonResponse($produtos, 201);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categorias,id'
        ]);

        $produto = Produto::create($validatedData);
        return new JsonResponse($produto, 201);
    }

    public function show($id)
    {
        $produto = Produto::find($id);
        if (!$produto) {
            return new JsonResponse(['error' => 'Produto not found'], 404);
        }
        return new JsonResponse($produto);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categorias,id'
        ]);

        $produto = Produto::find($id);
        if (!$produto) {
            return new JsonResponse(['error' => 'Produto not found'], 404);
        }
        $produto->update($validatedData);
        return new JsonResponse($produto);
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);
        if (!$produto) {
            return new JsonResponse(['error' => 'Produto not found'], 404);
        }
        $produto->delete();
        return new JsonResponse(['message' => 'Produto deleted successfully']);
    }
}
