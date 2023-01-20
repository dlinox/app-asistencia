<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Documento extends Model
{

    /**
 * The table associated with the model.
 *
 * @var string
 */
protected $table = 'documents' ;

    use HasFactory;
    protected $fillable = [
        'codigo',
        'url',
        'tipo',
        'dni_responsable',
        'id_area',
        'id_oficina',
        'id_usuario'
    ];

}
