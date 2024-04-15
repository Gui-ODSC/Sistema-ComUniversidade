<?php 

namespace App\Enums;

enum DuracaoOfertaAcao:string
{
    case DIAS = 'DIAS';
    case SEMANAS = 'SEMANAS';
    case MESES = 'MESES';
    case ANOS = 'ANOS';
    case INDEFINIDO = 'INDEFINIDO';
}