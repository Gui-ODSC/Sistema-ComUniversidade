<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicoAlvo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'PublicoAlvo';

    protected $primaryKey = 'id_publico_alvo'; 

    protected $fillable = [
        'nome'
    ];
}
