<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Dispositivo;

class DispositivoController extends Controller
{
    public function insertDispositivo(Request $rq){
        if (!$rq->id_dispositivo || !$rq->nombre) {
            return response()->json(['success'=>false, 'mensaje'=>'Debe ingresar los datos'],422);
        }else{
            $dispositivo = new Dispositivo();
            $dispositivo->nombre = $rq->nombre;
            $dispositivo->id_dispositivo = $rq->id_dispositivo;
            if ($dispositivo->save()) {
                $dataJSON = [
                    'success' => true,
                    'dispositivo' => array(
                        'id_dispositivo' => $rq->id_dispositivo,
                        'nombre' => $rq->nombre
                    )
                ];
            }
            return response()->json($dataJSON, 201);
        }
    }

    public function getDispositivo(){
        $dispositivo_DB = Dispositivo::select('id_dispositivo', 'nombre')->get();
        return response()->json($dispositivo_DB, 200);    
        
    }
}
