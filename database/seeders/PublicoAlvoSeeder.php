<?php

namespace Database\Seeders;

use App\Models\PublicoAlvo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicoAlvoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publicoAlvoList = [
            ['nome' => 'estudantes de educação básica', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'estudantes de educação infantil', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'estudantes de educação superior', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'quilombolas', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'indígenas', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'estudantes de EJA', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'terceira idade', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'empresas privadas', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'empresas públicas', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'público em geral', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'agricultores', 'created_at' => now(), 'updated_at' => now()],
        ];

        PublicoAlvo::insert($publicoAlvoList);
    }
}
