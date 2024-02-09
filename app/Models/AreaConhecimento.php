<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaConhecimento extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'AreaConhecimento';

    protected $primaryKey = 'id_area_conhecimento'; 

    protected $fillable = [
        'nome'
    ];
    
}
