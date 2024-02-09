<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAcao extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'TipoAcao';

    protected $primaryKey = 'id_tipo_acao'; 

    protected $fillable = [
        'nome_modalidade'
    ];
}
