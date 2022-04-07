<?php

namespace App\Http\Controllers;

use App\Model\Venta;
use App\Model\Comercio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VentaController extends Controller
{
    
    public function insertVenta(){
        $rut = "9999999-9";
        $id_dispositivo = "1111";
        $monto = "149000";
        $code_segurity = $this->code_segurity();
        $codigo_seguridad = Hash::make($code_segurity);
        $estado= true;
        echo "Codigo Seguridad: ".$code_segurity."<br>";

        $venta = new Venta();
        $venta->rut = $rut;
        $venta->id_dispositivo = $id_dispositivo;
        $venta->monto = $monto;
        $venta->codigo_seguridad = $codigo_seguridad;
        $venta->estado = $estado;
        if ($venta->save()) {
            echo "registro";
            $this->puntosComercio('vendio', $rut);
        }else {
            echo "no registro";
        }
    }

    public function anularVenta(){
        $rut = "9999999-9";
        $ventas = Venta::select('id_venta', 'codigo_seguridad')->where('rut', $rut)->get();
        
        foreach ($ventas as $venta) {
            $id_venta = $venta->id_venta;
            $codigo_seguridad = $venta->codigo_seguridad;
            $codes = Hash::check('4295643726', $codigo_seguridad);
            if ($id_venta == 13 && $codes) {
                Venta::where('id_venta', $id_venta)->update(['estado' => false]);
                $this->puntosComercio("anular", $rut);
                echo "<br>se actualizo";
            }else{
                echo "<br>el id_venta y el codigo de Seguridad no son correcto";
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

    
}
