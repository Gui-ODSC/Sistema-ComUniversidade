<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UsuarioProfessor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'UsuarioProfessor';

    protected $primaryKey = 'id_usuario_professor'; 

    protected $fillable = [
        'link_curriculo'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function oferta():HasMany
    {
        return $this->hasMany(Oferta::class, 'id_usuario_professor', 'id_usuario_professor');
    }
}
