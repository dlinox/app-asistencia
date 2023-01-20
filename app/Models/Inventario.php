<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    
    protected $table = 'inventario';
    protected $fillable = [
        'codigo',
        'codigo_anterior',
        'nombre',
        'modelo',
        'numero',
        'serie',
        'idbienk',
        'id_persona', 
        'idpersona_otro',
        'id_area',
        'id_usuario',
        'id_estado',
        'observaciones',
    ];
}
