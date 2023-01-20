<?php

namespace App\Http\Controllers;

use App\Models\Oficina;
use Illuminate\Http\Request;

class OficinaController extends Controller
{
    public function getOficinas($term)
    {

        $res = Oficina::where('nombre', 'LIKE', '%' . $term . '%')
            ->orWhere('codigo', 'LIKE', '%' . $term . '%')
            ->get();
        //text

        $this->response['estado'] = true;
        $this->response['datos'] = $res;
        $this->response['mensaje'] = $term;
        return response()->json($this->response, 200);
    }
}
