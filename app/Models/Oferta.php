<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Oferta extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'Oferta';

    protected $primaryKey = 'id_oferta'; 

    protected $fillable = [
        'id_usuario_professor',
        'id_area_conhecimento',
        'titulo',
        'descricao',
        'tipo'
    ];

    public function usuarioProfessor():BelongsTo
    {
        return $this->belongsTo(UsuarioProfessor::class, 'id_usuario_professor', 'id_usuario_professor');
    }

    public function ofertaConhecimento():HasOne
    {
        return $this->hasOne(OfertaConhecimento::class, 'id_oferta', 'id_oferta');
    } 

    public function ofertaAcao():HasOne
    {
        return $this->hasOne(OfertaAcao::class, 'id_oferta', 'id_oferta');
    }

    public function areaConhecimento():BelongsTo
    {
        return $this->belongsTo(AreaConhecimento::class, 'id_area_conhecimento', 'id_area_conhecimento');
    }

    public function contato():HasOne
    {
        return $this->hasOne(Contato::class, 'id_oferta', 'id_oferta');
    }
}
