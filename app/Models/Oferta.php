<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Oferta';

    protected $primaryKey = 'id_oferta'; 

    protected $fillable = [
        'titulo',
        'descricao',
        'tipo'
    ];
}
