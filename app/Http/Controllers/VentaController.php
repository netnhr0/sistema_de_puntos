<?php

namespace App\Http\Controllers;

use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VentaController extends Controller
{
    
    public function insertVenta(){
        $rut = "99999999-9";
        $id_dispositivo = "1111";
        $monto = "149000";
        $codigo_seguridad = Hash::make($this->code_segurity());
        $estado= true;

        $venta = new Venta();
        $venta->rut = $rut;
        $venta->id_dispositivo = $id_dispositivo;
        $venta->monto = $monto;
        $venta->codigo_seguridad = $codigo_seguridad;
        $venta->estado = $estado;
        $venta->save();
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

    
}
