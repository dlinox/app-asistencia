<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Bienk;
use App\Models\Estado;
use App\Models\Inventario;
use App\Models\Oficina;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InventarioController extends Controller
{
    //

    public function index()
    {

        return Inertia::render('Admin/Inventarios/');
    }
    
    public function viewRegistroInventario()
    {

        $current_user =  Auth::user();

        $mis_areas = Area::select()
            ->join('grupo', 'grupo.id_area', '=', 'area.id')
            ->where('grupo.id_usuario', $current_user->id)
            //->where('id_oficina', $id)
            ->get();

        $estados = Estado::all();

        return Inertia::render('Inventario/', [
            'estados' => $estados,
            'mis_areas' => $mis_areas
        ]);
    }

    public function searchPersonas($term = '')
    {
        $res = Persona::where('nombres', 'LIKE', '%' . $term . '%')
            ->orWhere('dni', 'LIKE', '%' . $term . '%')
            ->orWhere('paterno', 'LIKE', '%' . $term . '%')
            ->orWhere('materno', 'LIKE', '%' . $term . '%')
            ->get();
        //text

        $this->response['estado'] = true;
        $this->response['datos'] = $res;
        // $this->response['mensaje'] = $request->id_persona;
        return response()->json($this->response, 200);
    }

    public function searchPersonasById($id)
    {
        $res = Persona::where('id', $id)->get();
        //text

        $this->response['estado'] = true;
        $this->response['datos'] = $res;
        //$this->response['mensaje'] = $request->id_persona;
        return response()->json($this->response, 200);
    }


    public function searchOficinaById($id)
    {
        $res = Oficina::find($id);
        //text

        $this->response['estado'] = true;
        $this->response['datos'] = $res;
        //$this->response['mensaje'] = $request->id_persona;
        return response()->json($this->response, 200);
    }
    public function searchOficinas($term = '')
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

    public function searchAreas($oficina = '')
    {
        $res = Area::where('id_oficina', $oficina)
            ->get();
        //text

        $this->response['estado'] = true;
        $this->response['datos'] = $res;
        $this->response['mensaje'] =   $oficina;
        return response()->json($this->response, 200);
    }


    public function searchCodigos($codigo = '')
    {
        $res = Bienk::select('bienk.*', 'area.id_oficina')
            ->join('area', 'area.id', '=', 'id_area')->where('codigo', 'LIKE', $codigo . '%')

            ->get();
        //text

        $this->response['estado'] = true;
        $this->response['datos'] = $res;
        $this->response['mensaje'] =   $codigo;
        return response()->json($this->response, 200);
    }

    public function getBienes(Request $request)
    {
        $res = BienK::select('bienk.*', 'area.id_oficina', 'inventario.id as id_inventario')
            ->join('area', 'area.id', '=', 'bienk.id_area')
            ->leftjoin('inventario', 'inventario.idbienk', '=', 'bienk.id')
            ->where(function ($query) use ($request) {

                if ($request->mostrar == 'Registrados') {
                    $temp = $query
                        ->where('bienk.id_area', $request->area)
                        ->whereNotNull('inventario.id');
                } else if ($request->mostrar == 'Sin registrar') {
                    $temp = $query
                        ->where('bienk.id_area', $request->area)
                        ->whereNull('inventario.id');
                } else {
                    $temp = $query
                        ->where('bienk.id_area', $request->area);
                }

                return $temp;
            })
            ->where(function ($query) use ($request) {
                return $query
                    ->orWhere('bienk.codigo', 'LIKE', '%' . $request->term . '%')
                    ->orWhere('bienk.codigo_anterior', 'LIKE', '%' . $request->term . '%')
                    ->orWhere('bienk.nombre', 'LIKE', '%' . $request->term . '%');
            })->paginate(2);
 
        $this->response['estado'] = true;
        $this->response['datos'] = $res;
        $this->response['mensaje'] =   $request->area;
        return response()->json($this->response, 200);
    }

    public function saveInventario(Request $request)
    {

        $res = Inventario::create([
            'codigo' => $request->codigo,
            'codigo_anterior' => $request->codigo_anterior,
            'nombre' => $request->nombre,
            'modelo' => $request->modelo,
            'numero' => $request->numero,
            'serie' => $request->serie,
            'idbienk' => $request->id,
            'id_persona' => $request->id_persona,
            'idpersona_otro' => $request->idpersona_otro,
            'id_area' => $request->id_area,
            'id_usuario' => Auth::user()->id,
            'id_estado' => $request->id_estado,
            'observaciones' => $request->observaciones,
        ]);

        if ($res) {
            $this->response['mensaje'] = 'Exito, Inventario registrado';
            $this->response['estado'] = true;
            $this->response['codigo'] =  $request->id_area;
            $this->response['datos'] = $res;
            return response()->json($this->response, 200);
        }


        $this->response['mensaje'] = 'Error';
        $this->response['estado'] = true;
        $this->response['codigo'] =  $request->id_area;
        return response()->json($this->response, 200);
    }
}
