<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estado extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Estado';

    protected $primaryKey = 'id_estado'; 

    protected $fillable = [
        'nome'
    ];

    public function endereco(): BelongsTo
    {
        return $this->belongsTo(Endereco::class, 'id_estado', 'id_estado');
    }
}
