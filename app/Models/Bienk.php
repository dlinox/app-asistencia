<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bienk extends Model
{
    use HasFactory;

    protected $table = 'bienk' ;
    protected $fillable = [
        'codigo',
        'codigo_anterior',
        'nombre',
        'modelo',
        'numero',
        'serie',
        'id_persona',
        'id_area',
        'id_estado',
        'observaciones',

    ];
}
