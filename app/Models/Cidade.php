<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Cidade';

    protected $primaryKey = 'id_cidade'; 

    protected $fillable = [
        'nome'
    ];
}
