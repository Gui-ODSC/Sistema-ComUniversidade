<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = true;

    protected $table = 'Usuario';

    protected $primaryKey = 'id_usuario'; 

    protected $fillable = [
        'id_cep',
        'nome',
        'sobrenome',
        'nascimento',
        'telefone',
        'email',
        'email_secundario',
        'password',
        'foto',
        'tipo',
        'numero',
        'complemento',
        'tipo_pessoa',
        'instituicao',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function endereco():HasOne
    {
        return $this->HasOne(Cep::class, 'id_cep', 'id_cep');
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
