<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Comercio;
use Illuminate\Support\Facades\DB;

class ComercioController extends Controller
{

    public function insertComercio(Request $rq){
        if (!$rq->rut || !$rq->nombre) {
            return response()->json(['success'=>false, 'mensaje'=>'Debe ingresar los datos'],422);
        }else{
            $comercio = new Comercio();
            $comercio->rut = $rq->rut;
            $comercio->nombre = $rq->nombre;
            $comercio->puntos = 0;
            if ($comercio->save()) {
                $dataJSON = [
                    'success' => true,
                    'comercio' => array(
                        'rut' => $rq->rut,
                        'nombre' => $rq->nombre
                    )
                ];
            }
            return response()->json($dataJSON, 201);
        }
    }

    public function getComercioRut($rut){
        if (!$rut) {
            return response()->json(['success'=>false, 'mensaje'=>'Debe ingresar el rut'],422);
        }else{
            $comercio_DB = Comercio::select('rut', 'nombre', 'puntos')->where('rut', $rut)->get();
            return response()->json($comercio_DB, 200);
        }
    }

    public function getComercio(){
        $comercio = Comercio::select('rut', 'nombre', 'puntos')->get();
        return response()->json($comercio, 200);
    }

}
