<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsuarioAluno extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'UsuarioAluno';

    protected $primaryKey = 'id_usuario_aluno'; 

    protected $fillable = [
        'id_usuario',
        'curso',
        'ra'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
