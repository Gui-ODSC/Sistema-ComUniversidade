<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Endereco extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Endereco';

    protected $primaryKey = 'id_endereco'; 

    protected $fillable = [
        'numero',
        'complemento'
    ];

    public function bairro():BelongsTo
    {
        return $this->belongsTo(Bairro::class, 'id_bairro', 'id_bairro');
    }

    public function usuario():HasMany
    {
        return $this->hasMany(Usuario::class, 'id_endereco', 'id_endereco');
    }
}
