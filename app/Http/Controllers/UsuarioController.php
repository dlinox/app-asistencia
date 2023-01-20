<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function index()
    {

        return Inertia::render('Admin/Usuarios/', [
            'roles' =>  Role::all(),
        ]);
    }

    public function getUsuarios(Request $request)
    {

        $query_where = [];
        if ($request->rol) array_push($query_where, ['users.rol', '=', $request->rol]);
        if ($request->oficina) array_push($query_where, ['oficina.id', '=', $request->oficina]);
        if ($request->area) array_push($query_where, ['area.id', '=', $request->area]);

        $res = User::select(
            'users.*',
            DB::raw('GROUP_CONCAT(oficina.nombre SEPARATOR ",") as oficinas'),
            DB::raw('GROUP_CONCAT(area.nombre SEPARATOR ",") as areas')
        )
            ->leftjoin('grupo', 'grupo.id_usuario', '=', 'users.id')
            ->leftjoin('area', 'area.id', '=', 'grupo.id_area')
            ->leftjoin('oficina', 'area.id_oficina', '=', 'oficina.id')
            ->where($query_where)
            ->where(function ($query) use ($request) {
                return $query
                    ->orWhere('users.nombres', 'LIKE', '%' . $request->term . '%')
                    ->orWhere('users.apellidos', 'LIKE', '%' . $request->term . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $request->term . '%');
            })
            ->groupBy('users.id')
            ->paginate(2);


        $res->getCollection()->transform(function ($item) {
            return
                [
                    'id' => $item->id,
                    'nombres' => $item->nombres,
                    'apellidos' => $item->apellidos,
                    'email' => $item->email,
                    'rol' => $item->rol,
                    'rol_name'  => $item->getRoleNames()[0],
                    'areas' => array_unique(explode(",", $item->areas)),
                    'oficinas' => array_unique(explode(",", $item->oficinas))
                ];
        });

        $this->response['estado'] = true;
        $this->response['datos'] = $res;
        $this->response['mensaje'] =   $request->area;
        return response()->json($this->response, 200);
    }

    public function asignarArea(Request $request)
    {

        foreach ($request->areas as $area) {
            $create = Grupo::create([
                'id_usuario' => $request->usuario,
                'id_area' => $area,
            ]);
        }

        $this->response['estado'] = true;

        $this->response['areas'] =   $request->areas;
        $this->response['usuario'] =   $request->usuario;
        return response()->json($this->response, 200);
    }
}
