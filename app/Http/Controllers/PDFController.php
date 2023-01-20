<?php
namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Document;
use App\Models\Bienk;
use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \PDF;

class PDFController extends Controller
{
    public function pdfCreate(){
        $pdf = PDF::loadView('Prueba');
        return $pdf->download('prueba.pdf');
    }

    // public function verReportes(){

    // }

    public function PDFBienes($idArea){

        $oficina = DB::select('SELECT oficina.id, oficina.codigo, oficina.nombre FROM oficina WHERE oficina.id IN (SELECT area.id_oficina FROM area WHERE area.id ='.$idArea.')');
        $area = DB::select('SELECT * from  area WHERE area.id ='.$idArea.';');
        $responsable = DB::select('SELECT persona.dni, persona.nombres, persona.paterno, persona.materno FROM persona WHERE persona.id IN (SELECT DISTINCT(id_persona) from bienk WHERE id_area ='.$idArea.');');
        $responsable2 = DB::select('SELECT persona.dni, persona.nombres, persona.paterno, persona.materno FROM persona WHERE persona.id IN (SELECT DISTINCT(idpersona_otro) from bienk WHERE id_area ='.$idArea.');');
        $inventarista = DB::select('SELECT * FROM users WHERE users.id in (SELECT grupo.id_usuario FROM grupo WHERE id_area ='.$idArea.');');
        $bienes = DB::select('SELECT * from inventario WHERE id_area = '.$idArea.' and id_usuario='.$inventarista[0]->id.';');
        $ldate = date('d-m-Y');
        $lhour = date('H:i:s',strtotime('-5 hours'));
        $pdf = PDF::loadView('Bienes', compact('bienes','oficina','area','responsable','responsable2','inventarista','ldate','lhour'));
//        $pdf->output(['/public','F']);
        $pdf->setPaper('a4','landscape');
        $nro = Documento::max('id')+1;
        if ($nro < 10) {
            $codigo = 'CBI-'.date('d').date('m').date('Y').'-000000'.$nro;
        }else{
            $codigo = 'CBI-'.date('d').date('m').date('Y').'-00000'.$nro;
        }
        $output = $pdf->output();

        file_put_contents(public_path().'/documents/cargos/'.$codigo.'.pdf', $output);

        $doc['codigo'] = $codigo;
        $doc['url'] = '/documents/cargos/'.$codigo.'.pdf';
        $doc['tipo'] = 1;
        $doc['dni_responsable'] = $responsable[0]->dni;
        $doc['id_area'] = $idArea;
        $doc['id_oficina'] = $oficina[0]->id;
        $doc['id_usuario'] = Auth::id();
        Documento::create($doc);

        //return public_path();
        return $pdf->stream();
    }

    public function genCargos( Request $request ){
        $i = 0;
        foreach ($request as $key => $user){
          $this->PDFBienes($request[$i]['id']);
          $i++;
        }
        $i = 0;
        return "Exito";
    }

    public function getAreaByPersons ( $id ){
        $areas = Area::select()
        ->where('id_persona', $id)
        ->get();

        return $areas;
    }

}
