<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContatoMensagem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ContatoMensagem';

    protected $primaryKey = 'id_contato_mensagem'; 

    protected $fillable = [
        'mensagem'
    ];
}
