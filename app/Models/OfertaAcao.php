<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfertaAcao extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'OfertaAcao';

    protected $primaryKey = 'id_oferta_acao'; 

    protected $fillable = [
        'id_oferta',
        'id_tipo_acao',
        'id_publico_alvo',
        'status_registro',
        'duracao',
        'regime',
        'data_limite'
    ];

    public function oferta():BelongsTo
    {
        return $this->belongsTo(Oferta::class, 'id_oferta', 'id_oferta');
    }

    public function tipoAcao():BelongsTo
    {
        return $this->belongsTo(TipoAcao::class, 'id_tipo_acao', 'id_tipo_acao');
    }

    public function publicoAlvo():BelongsTo
    {
        return $this->belongsTo(PublicoAlvo::class, 'id_publico_alvo', 'id_publico_alvo');
    }
}
