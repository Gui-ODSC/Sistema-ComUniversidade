<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Endereco';

    protected $primaryKey = 'id_endereco'; 

    protected $fillable = [
        'numero',
        'complemento'
    ];
}
