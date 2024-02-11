<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AreaConhecimento extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'AreaConhecimento';

    protected $primaryKey = 'id_area_conhecimento'; 

    protected $fillable = [
        'nome'
    ];
    
    public function oferta():HasMany
    {
        return $this->hasMany(Oferta::class, 'id_area_conhecimento', 'id_area_conhecimento');
    }

    public function demanda():HasMany
    {
        return $this->hasMany(Demanda::class, 'id_demanda', 'id_demanda');
    }
}
