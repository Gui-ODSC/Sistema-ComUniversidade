<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Estado';

    protected $primaryKey = 'id_estado'; 

    protected $fillable = [
        'nome'
    ];

    public function cep(): HasMany
    {
        return $this->hasMany(Cep::class, 'id_estado', 'id_estado');
    }
}
