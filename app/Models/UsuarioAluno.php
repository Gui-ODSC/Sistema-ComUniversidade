<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioAluno extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'UsuarioAluno';

    protected $primaryKey = 'id_usuario_aluno'; 

    protected $fillable = [
        'curso',
        'ra'
    ];
}
