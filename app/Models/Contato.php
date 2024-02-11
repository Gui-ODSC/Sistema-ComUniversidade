<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contato extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Contato';

    protected $primaryKey = 'id_contato'; 


    public function demanda():BelongsTo
    {
        return $this->belongsTo(Demanda::class, 'id_demanda', 'id_demanda');
    }

    public function oferta():BelongsTo
    {
        return $this->belongsTo(Oferta::class, 'id_oferta', 'id_oferta');
    }

    public function usuarioOrigem():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_origem', 'id_usuario');
    }

    public function usuarioDestino():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_destino', 'id_usuario');
    }

    public function contatoMensagem():HasMany
    {
        return $this->hasMany(ContatoMensagem::class, 'id_contato', 'id_contato');
    }
}
