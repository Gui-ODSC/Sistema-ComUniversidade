<?php

namespace Database\Seeders;

use App\Models\AreaConhecimento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaConhecimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areaConhecimentoList = [
            ['nome' => 'Matemática', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Probabilidade e Estatística', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Ciência da Computação', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Astronomia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Física', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Química', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'GeoCiências', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Oceanografia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Biologia Geral', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Genética', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Botânica', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Zoologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Ecologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Morfologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Fisiologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Bioquímica', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Biofísica', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Farmacologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Imunologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Microbiologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Parasitologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia Civil', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia de Minas', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia de Materiais e Metalúrgica', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia Elétrica', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia Mecânica', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia Química', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia Sanitária', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia de Produção', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia Nuclear', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia de Transportes', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia Naval e Oceânica', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia Aeroespacial', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia Biomédica', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Medicina', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Odontologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Farmácia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Enfermagem', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Nutrição', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Saúde Coletiva', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Fonoaudiologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Fisioterapia e Terapia Ocupacional', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Educação Física', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Agronomia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Recursos Florestais e Engenharia Florestal', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Engenharia Agrícola', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Zootecnia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Medicina Veterinária', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Recursos Pesqueiros e Engenharia de Pesca', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Ciência e Tecnologia de Alimentos', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Direito', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Administração', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Economia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Arquitetura e Urbanismo', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Planejamento Urbano e Regional', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Demografia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Ciência da Informação', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Museologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Comunicação', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Serviço Social', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Economia Doméstica', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Desenho Industrial', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Turismo', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Filosofia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Sociologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Antropologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Arqueologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'História', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Geografia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Psicologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Educação', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Ciência Política', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Teologia', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Linguística', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Letras', 'created_at' => null, 'updated_at' => null],
            ['nome' => 'Artes', 'created_at' => null, 'updated_at' => null],
        ];


        // Inserir os dados na tabela 'products'
        AreaConhecimento::insert($areaConhecimentoList);
    }
}
