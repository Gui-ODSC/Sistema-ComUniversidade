<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioProfessor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'UsuarioProfessor';

    protected $primaryKey = 'id_usuario_professor'; 

    protected $fillable = [
        'link_curriculo'
    ];
}
