<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoria = new Categoria();
        $categoria->name = 'Studio';
        $categoria->active = true;
        $categoria->created_by = 1;
        $categoria->save();

        $categoria2 = new Categoria();
        $categoria2->name = 'Casa Verde e Amarela';
        $categoria2->active = true;
        $categoria2->created_by = 1;
        $categoria2->save();

        $categoria3 = new Categoria();
        $categoria3->name = 'Alto Padrão';
        $categoria3->active = true;
        $categoria3->created_by = 1;
        $categoria3->save();

        $categoria4 = new Categoria();
        $categoria4->name = 'Lote';
        $categoria4->active = true;
        $categoria4->created_by = 1;
        $categoria4->save();

        $categoria5 = new Categoria();
        $categoria5->name = 'Rural';
        $categoria5->active = true;
        $categoria5->created_by = 1;
        $categoria5->save();
    }
}
