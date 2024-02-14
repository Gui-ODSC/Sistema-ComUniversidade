<?php 

namespace App\Enums;

enum TipoUsuarioEnum: string
{
	case MEMBRO = 'MEMBRO';
	case ALUNO = 'ALUNO';
	case PROFESSOR = 'PROFESSOR';
}