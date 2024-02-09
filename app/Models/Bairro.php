<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Bairro';

    protected $primaryKey = 'id_bairro'; 

    protected $fillable = [
        'nome'
    ];
}
