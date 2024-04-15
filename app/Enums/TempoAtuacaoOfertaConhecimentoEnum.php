<?php 

namespace App\Enums;

enum TempoAtuacaoOfertaConhecimentoEnum: string
{
    case MENOS_1_ANO = 'MENOS_1_ANO';
    case MAIS_1_ANO = 'MAIS_1_ANO';
    case MAIS_3_ANOS = 'MAIS_3_ANOS';
    case MAIS_5_ANOS = 'MAIS_5_ANOS';
}