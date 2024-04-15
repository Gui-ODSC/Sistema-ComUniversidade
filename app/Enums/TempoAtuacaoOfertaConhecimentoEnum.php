<?php 

namespace App\Enums;

enum TempoAtuacaoOfertaConhecimentoEnum: string
{
    case MENOS_1_ANO = '-1ANO';
    case MAIS_1_ANO = '+1ANO';
    case MAIS_3_ANOS = '+3ANOS';
    case MAIS_5_ANOS = '+5ANOS';
}