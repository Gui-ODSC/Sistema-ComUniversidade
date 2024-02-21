<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Endereco extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Endereco';

    protected $primaryKey = 'id_endereco'; 

    protected $fillable = [
        'id_bairro',
        'id_cidade',
        'id_estado',
        'rua',
        'numero',
        'complemento'
    ];

    public function bairro():HasOne
    {
        return $this->hasOne(Bairro::class, 'id_bairro', 'id_bairro');
    }

    public function cidade():HasOne
    {
        return $this->hasOne(Cidade::class, 'id_cidade', 'id_cidade');
    }

    public function estado():HasOne
    {
        return $this->hasOne(Bairro::class, 'id_estado', 'id_estado');
    }

    public function usuario():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_endereco', 'id_endereco');
    }
}
