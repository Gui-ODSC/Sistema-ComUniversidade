<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contato extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Contato';

    protected $primaryKey = 'id_contato'; 

    protected $fillable = [
        'id_usuario_origem',
        'id_usuario_destino',
        'id_oferta',
        'id_demanda',
    ];

    public function demanda():HasOne
    {
        return $this->hasOne(Demanda::class, 'id_demanda', 'id_demanda');
    }

    public function oferta():HasOne
    {
        return $this->hasOne(Oferta::class, 'id_oferta', 'id_oferta');
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
