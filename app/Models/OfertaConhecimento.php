<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaConhecimento extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'OfertaConhecimento';

    protected $primaryKey = 'id_oferta_conhecimento'; 

    protected $fillable = [
        'tempo_atuacao',
        'link_lattes',
        'link_linkedin'
    ];
}
