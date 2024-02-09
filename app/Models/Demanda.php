<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demanda extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Demanda';

    protected $primaryKey = 'id_demanda'; 

    protected $fillable = [
        'titulo',
        'descricao',
        'pessoas_afetadas',
        'duracao',
        'nivel_prioridade',
        'instituicao_setor'
    ];
}
