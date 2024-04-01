<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContatosDiretosVisualizados extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'ContatosDiretosVisualizados';

    protected $primaryKey = 'id_contato_direto_visualizado';

    protected $fillable = [
        'id_usuario',
        'id_demanda',
        'id_oferta',
    ];

    public function Usuario():BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function Demanda():BelongsTo
    {
        return $this->belongsTo(Demanda::class, 'id_demanda', 'id_demanda');
    }

    public function Oferta():BelongsTo
    {
        return $this->belongsTo(Oferta::class, 'id_oferta', 'id_oferta');
    }
}
