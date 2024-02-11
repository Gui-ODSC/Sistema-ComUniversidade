<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PublicoAlvo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'PublicoAlvo';

    protected $primaryKey = 'id_publico_alvo'; 

    protected $fillable = [
        'nome'
    ];

    public function ofertaAcao():HasMany
    {
        return $this->hasMany(OfertaAcao::class, 'id_publico_alvo', 'id_publico_alvo');
    }

    public function demanda():HasMany
    {
        return $this->hasMany(Demanda::class, 'id_demanda', 'id_demanda');
    }
}
