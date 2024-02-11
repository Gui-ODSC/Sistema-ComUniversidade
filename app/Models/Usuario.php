<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function endereco():BelongsTo
    {
        return $this->belongsTo(Endereco::class, 'id_endereco', 'id_endereco');
    }

    public function usuarioAluno():HasOne
    {
        return $this->hasOne(UsuarioAluno::class, 'id_usuario', 'id_usuario');
    }

    public function usuarioProfessor():HasOne
    {
        return $this->hasOne(UsuarioProfessor::class, 'id_usuario', 'id_usuario');
    }

    public function demanda():HasMany
    {
        return $this->hasMany(Demanda::class, 'id_demanda', 'id_demanda');
    }

    public function contatosOrigem()
    {
        return $this->hasMany(Contato::class, 'id_usuario_origem', 'id_usuario');
    }

    public function contatosDestino()
    {
        return $this->hasMany(Contato::class, 'id_usuario_destino', 'id_usuario');
    }

    public function contatosMensagensOrigem()
    {
        return $this->hasMany(ContatoMensagem::class, 'id_usuario_origem', 'id_usuario');
    }

    public function contatosMensagensDestino()
    {
        return $this->hasMany(ContatoMensagem::class, 'id_usuario_destino', 'id_usuario');
    }

}
