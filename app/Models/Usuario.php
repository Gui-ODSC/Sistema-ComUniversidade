<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Usuario';

    protected $primaryKey = 'id_usuario'; 

    protected $fillable = [
        'nome',
        'sobrenome',
        'nascimento',
        'telefone',
        'email_primario',
        'email_secundario',
        'senha',
        'tipo'
    ];
}
