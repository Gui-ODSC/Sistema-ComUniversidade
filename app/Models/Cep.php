<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cep extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'Cep';

    protected $primaryKey = 'id_cep'; 

    protected $fillable = [
        'cep',
        'logradouro',
        'bairro',
        'complemento',
        'id_cidade',
        'id_estado'
    ];

    public function cidade():BelongsTo
    {
        return $this->belongsTo(Cidade::class, 'id_cidade', 'id_cidade');
    }

    public function estado():BelongsTo
    {
        return $this->belongsTo(Estado::class, 'id_estado', 'id_estado');
    }

}
