<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cidade extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Cidade';

    protected $primaryKey = 'id_cidade'; 

    protected $fillable = [
        'nome',
    ];

    public function cep():HasMany
    {
        return $this->hasMany(Cep::class, 'id_cidade', 'id_cidade');
    }
}
