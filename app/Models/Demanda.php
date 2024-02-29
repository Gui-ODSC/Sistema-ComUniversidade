<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Demanda extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'Demanda';

    protected $primaryKey = 'id_demanda'; 

    protected $fillable = [
        'id_usuario',
        'id_publico_alvo',
        'id_area_conhecimento',
        'titulo',
        'descricao',
        'pessoas_afetadas',
        'duracao',
        'nivel_prioridade',
        'instituicao_setor'
    ];

    public function publicoAlvo():BelongsTo
    {
        return $this->belongsTo(PublicoAlvo::class, 'id_publico_alvo', 'id_publico_alvo');
    }

    public function usuario():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function areaConhecimento():BelongsTo
    {
        return $this->belongsTo(AreaConhecimento::class, 'id_area_conhecimento', 'id_area_conhecimento');
    }

    public function contato():HasOne
    {
        return $this->hasOne(Contato::class, 'id_contato', 'id_contato');
    }

}
