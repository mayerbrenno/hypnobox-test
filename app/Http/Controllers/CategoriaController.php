<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return new JsonResponse($categorias, 201);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'active' => 'required|boolean'
        ]);

        $categoria = Categoria::create($validatedData);
        return new JsonResponse($categoria, 201);
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return new JsonResponse(['error' => 'Categoria não encontrada'], 404);
        }
        return new JsonResponse($categoria);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'active' => 'required|boolean',
        ]);

        $categoria = Categoria::find($id);
        if (!$categoria) {
            return new JsonResponse(['error' => 'Categoria não encontrada'], 404);
        }
        $categoria->update($validatedData);
        return new JsonResponse($categoria);
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return new JsonResponse(['error' => 'Categoria não encontrada'], 404);
        }
        $categoria->delete();
        return new JsonResponse(['message' => 'Categoria removida com sucesso']);
    }
}
