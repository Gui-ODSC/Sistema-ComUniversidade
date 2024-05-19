<?php

namespace Database\Seeders;

use App\Models\TipoAcao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoAcaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoAcaoList = [
            ['nome' => 'Curso', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Projeto', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Programa', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Evento', 'created_at' => now(), 'updated_at' => now()],
        ];

        TipoAcao::insert($tipoAcaoList);
    }
}
