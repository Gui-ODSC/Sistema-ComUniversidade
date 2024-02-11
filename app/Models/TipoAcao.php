<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoAcao extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'TipoAcao';

    protected $primaryKey = 'id_tipo_acao'; 

    protected $fillable = [
        'nome_modalidade'
    ];

    public function ofertaAcao():HasMany
    {
        return $this->hasMany(OfertaAcao::class, 'id_tipo_oferta', 'id_tipo_oferta');
    }
}
