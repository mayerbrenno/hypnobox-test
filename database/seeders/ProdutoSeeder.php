<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produto = new Produto();
        $produto->name = 'Studio Inovação';
        $produto->description = 'Studio Inovação';
        $produto->price = 1000000;
        $produto->category_id = 1;
        $produto->created_by = 1;
        $produto->save();

        $produto2 = new Produto();
        $produto2->name = 'Imóvel do Interior';
        $produto2->description = 'Imóvel do Interior';
        $produto2->price = 850000;
        $produto2->category_id = 5;
        $produto2->created_by = 1;
        $produto2->save();

        $produto3 = new Produto();
        $produto3->name = 'Imóvel Pinheiros';
        $produto3->description = 'Imóvel Pinheiros';
        $produto3->price = 2500000;
        $produto3->category_id = 3;
        $produto3->created_by = 1;
        $produto3->save();

        $produto4 = new Produto();
        $produto4->name = 'Casa Verde e Amarela';
        $produto4->description = 'Casa Verde e Amarela';
        $produto4->price = 150000;
        $produto4->category_id = 2;
        $produto4->created_by = 1;
        $produto4->save();

        $produto5 = new Produto();
        $produto5->name = 'Terreno Centro';
        $produto5->description = 'Terreno Centro';
        $produto5->price = 350000;
        $produto5->category_id = 4;
        $produto5->created_by = 1;
        $produto5->save();

        $produto6 = new Produto();
        $produto6->name = 'Terreno Norte';
        $produto6->description = 'Terreno Norte';
        $produto6->price = 200000;
        $produto6->category_id = 4;
        $produto6->created_by = 1;
        $produto6->save();

        $produto7 = new Produto();
        $produto7->name = 'Terreno 1 Hectare Interior';
        $produto7->description = 'Terreno 1 Hectare Interior';
        $produto7->price = 15000000;
        $produto7->category_id = 5;
        $produto7->created_by = 1;
        $produto7->save();

        $produto8 = new Produto();
        $produto8->name = 'Apartamento Studio New Inovation';
        $produto8->description = 'Apartamento Studio New Inovation';
        $produto8->price = 1100000;
        $produto8->category_id = 1;
        $produto8->created_by = 1;
        $produto8->save();

        $produto9 = new Produto();
        $produto9->name = 'CDHU Centro';
        $produto9->description = 'CDHU Centro';
        $produto9->price = 100000;
        $produto9->category_id = 2;
        $produto9->created_by = 1;
        $produto9->save();

        $produto10 = new Produto();
        $produto10->name = 'Apartamento Vista';
        $produto10->description = 'Apartamento Vista';
        $produto10->price = 5500000;
        $produto10->category_id = 3;
        $produto10->created_by = 1;
        $produto10->save();
    }
}
