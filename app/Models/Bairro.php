<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bairro extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Bairro';

    protected $primaryKey = 'id_bairro'; 

    protected $fillable = [
        'nome'
    ];

    public function cidade():BelongsTo
    {
        return $this->belongsTo(Cidade::class, 'id_cidade', 'id_cidade');
    }

    public function endereco():HasMany
    {
        return $this->hasMany(Endereco::class, 'id_bairro', 'id_bairro');
    }
}
