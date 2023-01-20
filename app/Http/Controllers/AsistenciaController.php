<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AsistenciaController extends Controller
{
    public function ListaAsistencia($fecha)
    {
        $trabajadores =  Asistencia::whereDate('asi_fecha', $fecha)->get()->map(function ($item) {
            return [
                'id' => $item->asi_id,

                'trabajador' => Trabajador::select(DB::raw("CONCAT(tra_nombre,' ', tra_apellidos)  AS nombre , CONCAT( hor_inicio , ' - ' , hor_fin) as horario"))
                    ->join('horarios', 'horarios.hor_id', '=', 'tra_horario')
                    ->where('tra_id', $item->asi_trabajador)
                    ->first(),
                'entrada' => $item->asi_entrada,
                'salida' => $item->asi_salida,
                'estado' => $item->asi_estado,
            ];
        });

        $this->response['mensaje'] = 'Operación exitosa';
        $this->response['estado'] = true;
        $this->response['select_fecha'] =  date('F j, Y', strtotime($fecha));
        $this->response['datos'] = $trabajadores;
        return response()->json($this->response, 200);
    }

    public function HorasAsistencia($fecha)
    {
        $_fecha = Carbon::parse($fecha);
        $mes =  Carbon::parse($fecha)->month;
        $anio = Carbon::parse($fecha)->year;

        $trabajadores = Asistencia::groupBy('asi_trabajador')
            ->selectRaw("CONCAT(tra_nombre,' ', tra_apellidos)  AS nombre, asi_trabajador , sum(asi_horas_trabajo) as horas")
            ->join('trabajadors', 'asi_trabajador', '=', 'tra_id')
            ->whereRaw(" MONTH(asi_fecha) = $mes AND YEAR(asi_fecha) = $anio")
            ->get();

        //Carbon::parse()

        /*
        $trabajadores =  Asistencia::whereDate('asi_fecha', $fecha)->get()->map(function ($item) {
            return [
                'id' => $item->asi_id,

                'trabajador' => Trabajador::select(DB::raw("CONCAT(tra_nombre,' ', tra_apellidos)  AS nombre , CONCAT( hor_inicio , ' - ' , hor_fin) as horario"))
                    ->join('horarios', 'horarios.hor_id', '=', 'tra_horario')
                    ->where('tra_id', $item->asi_trabajador)
                    ->first(),
                'entrada' => $item->asi_entrada,
                'salida' => $item->asi_salida,
                'estado' => $item->asi_estado,
            ];
        }); */

        setlocale(LC_ALL, "es_PE");

        $this->response['mensaje'] = $anio;
        $this->response['estado'] = true;
        $this->response['select_fecha'] =  date('F, Y', strtotime($_fecha));
        $this->response['datos'] = $trabajadores;
        return response()->json($this->response, 200);
    }


    public function GenerarAsistencia(Request $request)
    {

        $res = Asistencia::whereDate('asi_fecha', $request->fecha)->get();

        if (count($res) > 0) {
            $this->response['mensaje'] = 'Ya exite asistencia para' . $request->fecha;
            $this->response['estado'] = false;
            $this->response['datos'] = $res;
            return response()->json($this->response, 200);
        }

        $trabajadores = Trabajador::select('tra_id')
            ->where('tra_estado', 1)
            ->get();

        foreach ($trabajadores as $tra_id) {
            Asistencia::create([
                'asi_trabajador' => $tra_id->tra_id,
                'asi_fecha' => $request->fecha,
            ]);
        }

        $this->response['mensaje'] = 'Operación exitosa' . $request->fecha;
        $this->response['estado'] = true;
        $this->response['datos'] = $trabajadores;
        return response()->json($this->response, 200);
    }

    public function GetAsistencia($dni)
    {


        $res  = Asistencia::select('asi_id', 'asi_entrada', 'asi_salida', 'asi_estado', 'tra_id', 'tra_nombre', 'tra_apellidos')
            ->join('trabajadors', 'trabajadors.tra_id', '=', 'asi_trabajador')
            ->whereDate('asi_fecha', Carbon::today())
            ->where('trabajadors.tra_documento', $dni)
            ->first();

        if (!$res) {
            $this->response['error'] = 'Trabajador no encontrado';
            $this->response['estado'] = true;
            return response()->json($this->response, 400);
        }

        $this->response['mensaje'] = 'Operación exitosa';
        $this->response['estado'] = true;
        $this->response['datos'] = $res;
        return response()->json($this->response, 200);
    }

    public function IngresoAsistencia(Request $request)
    {
        $res = Asistencia::find($request->id);

        $trabajador = Trabajador::select('hor_inicio', 'hor_fin')
            ->join('horarios', 'horarios.hor_id', '=', 'tra_horario')
            ->where('tra_id', $res->asi_trabajador)
            ->first();

        $hora_llegada = Carbon::parse($request->hora);
        $hora_entrada = Carbon::parse($trabajador->hor_inicio);

        $diferencia = $hora_llegada->diffInMinutes($hora_entrada);
        if ($hora_llegada > $hora_entrada && $diferencia > 10) {
            $estado = 'Tarde';
        } else {
            $estado = 'Puntual';
        }

        $res->asi_entrada = $request->hora;
        $res->asi_estado = $estado;


        if ($res->save()) {
            $this->response['mensaje'] = 'Operación exitosa';
            $this->response['estado'] = true;
            return response()->json($this->response, 200);
        }

        $this->response['error'] = 'Ocurrio Un error';
        $this->response['estado'] = false;
        return response()->json($this->response, 400);
    }

    public function SalidaAsistencia(Request $request)
    {
        $res = Asistencia::find($request->id);

        $hora_entrada = Carbon::parse($res->asi_entrada);
        $hora_salida = Carbon::parse($request->hora);
        $horas_trabajo = $hora_salida->diffInSeconds($hora_entrada);

        $res->asi_salida = $request->hora;
        $res->asi_horas_trabajo = $horas_trabajo;

        if ($res->save()) {
            $this->response['mensaje'] = 'Operación exitosa';
            $this->response['estado'] = true;
            return response()->json($this->response, 200);
        }

        $this->response['error'] = 'Ocurrio Un error';
        $this->response['estado'] = false;
        return response()->json($this->response, 400);
    }

    public function PageTrabajadores()
    {
        return Inertia::render('admin/trabajador/', [
            'trabajadores' => Trabajador::all()->map(function ($item) {
                return [
                    'id' => $item->tra_id,
                    'nombre' => $item->tra_nombre,
                    'apellidos' => $item->tra_apellidos,
                    'correo' => $item->tra_correo,
                    'nacionalidad' => $item->tra_nacionalidad,
                    'celular' => $item->tra_celular,
                    'documento' => $item->tra_documento,
                    'puesto' => $item->tra_puesto,
                    'oficina' => $item->tra_oficina,
                    'horario' => $item->tra_horario,
                    'horas' => Horario::select(DB::raw("CONCAT( hor_inicio , ' - ' , hor_fin) as horario"), 'hor_id as id')
                        ->where('hor_id', $item->tra_horario)
                        ->first(),
                    'codigo' => $item->tra_codigo,
                ];
            }),
            'oficinas' => Oficina::all()->map(function ($item) {
                return [
                    'id' => $item->ofi_id,
                    'text' => $item->ofi_nombre,
                ];
            }),
            'puestos' => Puesto::all()->map(function ($item) {
                return [
                    'id' => $item->pue_id,
                    'text' => $item->pue_nombre,
                ];
            }),
            'horarios' => Horario::all()->map(function ($item) {
                return [
                    'id' => $item->hor_id,
                    'text' => $item->hor_turno . ' ( ' . $item->hor_inicio . ' - ' . $item->hor_fin . ' )',
                ];
            })

        ]);
    }
}
