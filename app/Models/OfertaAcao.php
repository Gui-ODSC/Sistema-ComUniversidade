<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaAcao extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'OfertaAcao';

    protected $primaryKey = 'id_oferta_acao'; 

    protected $fillable = [
        'status_registro',
        'duracao',
        'regime'
    ];
}
