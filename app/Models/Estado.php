<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Estado';

    protected $primaryKey = 'id_estado'; 

    protected $fillable = [
        'nome'
    ];

}
