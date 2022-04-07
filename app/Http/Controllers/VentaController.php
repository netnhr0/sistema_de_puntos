<?php

namespace App\Http\Controllers;

use App\Model\Venta;
use App\Model\Comercio;
use App\Model\Dispositivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VentaController extends Controller
{
    
    public function insertVenta(Request $rq){
        if (!$rq->rut || !$rq->id_dispositivo || !$rq->monto) {
            return response()->json(['success'=>false, 'mensaje'=>'Debe ingresar los datos'],422);
        }else{
            $rut = $rq->rut;
            $id_dispositivo = $rq->id_dispositivo;
            $monto = $rq->monto;
            $code_segurity = $this->code_segurity();
            $codigo_seguridad = Hash::make($code_segurity);
            $estado= true;

            if (Comercio::where('rut', $rut)->exists()) {
                if (Dispositivo::where('id_dispositivo', $id_dispositivo)->exists()) {
                    if (is_numeric($rq->monto)) {                    
                        $venta = new Venta();
                        $venta->rut = $rut;
                        $venta->id_dispositivo = $id_dispositivo;
                        $venta->monto = $monto;
                        $venta->codigo_seguridad = $codigo_seguridad;
                        $venta->estado = $estado;
                        if ($venta->save()) {
                            $id_venta = Venta::latest('id_venta')->first();
                            $this->puntosComercio('vendio', $rut);
                            $dataJSON = [
                                'success' => true,
                                'venta' => array(
                                    'id_venta' => $id_venta->id_venta,
                                    'rut' => $rut,
                                    'id_dispositivo' => $id_dispositivo,
                                    'monto' => $monto,
                                    'codigo_seguridad' => $code_segurity
                                )
                            ];
                            return response()->json($dataJSON, 201);
                        } 
                    }else{
                        return response()->json(['mensaje'=>'El monto ingresado no es numerico'], 500);
                    }
                }else{
                    return response()->json(['error'=>500, 'mensaje'=>'El id_dispositivo ingresado No Existe'],500);
                }     
            }else{
                return response()->json(['error'=>500, 'mensaje'=>'El rut ingresado No Existe'],500);
            }
        }
    }

    public function anularVenta(Request $rq){
        if (!$rq->id_venta || !$rq->codigo_seguridad) {
            return response()->json(['success'=>false, 'mensaje'=>'Debe ingresar los datos'],422);
        }else{
            $ventas = Venta::select('id_venta', 'codigo_seguridad', 'rut')->where('id_venta', $rq->id_venta)->get();
            
            foreach ($ventas as $venta) {
                $id_venta = $venta->id_venta;
                $codigo_seguridad = $venta->codigo_seguridad;
                $codes = Hash::check($rq->codigo_seguridad, $codigo_seguridad);
                if ($id_venta == $rq->id_venta && $codes) {
                    Venta::where('id_venta', $rq->id_venta)->update(['estado' => false]);
                    $this->puntosComercio("anular", $venta->rut);
                    $dataJSON = [
                        'success'=>true,
                        'anular' => array(
                            'id_venta' => $rq->id_venta,
                            'codigo_seguridad' => $rq->codigo_seguridad
                        )
                    ];
                    return response()->json($dataJSON, 201);
                }else{
                    $dataJSON = [
                        'success'=>false,
                        'error'=>'400',
                        'mensaje' => 'El ID venta y el Codigo de Seguridad no son correcto'
                    ];
                }
            }
        }
    }

    private function code_segurity(){
        $code = '';
        if (strlen($code) < 10) {
            for ($i=0; $i < 10; $i++) { 
                $random = rand(0, 9);
                $code = $code."".$random;
            }
        }
        return $code;
    }

    private function puntosComercio($operacion, $rut){
        $puntosDB = DB::select('select puntos from comercios where rut = :rut', ['rut' => $rut]);
        foreach ($puntosDB as $puntos) {
            $punto = $puntos->puntos;
        }
        if ($operacion == "vendio") {
            $punto = $punto+10;
            Comercio::where('rut', $rut)->update(['puntos' => $punto]);
        }else if($operacion == "anular"){
            $punto = $punto-10;
            Comercio::where('rut', $rut)->update(['puntos' => $punto]);
        }
    }

    public function getVentas(){
        $ventas = DB::select('SELECT * FROM ventas');
        return response()->json($ventas, 200);
    }

    public function getVentasRut($rut){
        if (!$rut) {
            return response()->json(['success'=>false, 'mensaje'=>'Debe ingresar los datos'],422);
        }else{
            $ventas = Venta::select('id_venta', 'id_dispositivo', 'monto', 'estado')->where('rut', $rut)->get();
            return response()->json($ventas, 200);
        }
    }

}
