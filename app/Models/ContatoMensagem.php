<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContatoMensagem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ContatoMensagem';

    protected $primaryKey = 'id_contato_mensagem'; 

    protected $fillable = [
        'id_contato',
        'id_usuario_origem',
        'id_usuario_destino',
        'mensagem'
    ];

    public function contato():BelongsTo
    {
        return $this->belongsTo(Contato::class, 'id_contato', 'id_contato');
    }

    public function usuarioOrigem():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_origem', 'id_usuario');
    }

    public function usuarioDestino():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_destino', 'id_usuario');
    }
}
