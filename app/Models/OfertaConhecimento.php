<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfertaConhecimento extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'OfertaConhecimento';

    protected $primaryKey = 'id_oferta_conhecimento'; 

    protected $fillable = [
        'id_oferta',
        'tempo_atuacao',
        'link_lattes',
        'link_linkedin'
    ];

    public function oferta():BelongsTo
    {
        return $this->belongsTo(Oferta::class, 'id_oferta', 'id_oferta');
    }
}
