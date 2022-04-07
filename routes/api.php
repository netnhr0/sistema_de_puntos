<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/venta/insert', 'VentaController@insertVenta');
Route::post('/venta/cancelar', 'VentaController@anularVenta');
Route::get('/venta', 'VentaController@getVentas');

Route::get('/comercio', 'ComercioController@getComercio');
Route::post('/comercio/insert', 'ComercioController@insertComercio');
Route::get('/comercio/rut/{rut}', 'ComercioController@getComercioRut');

Route::post('/dispositivo/insert', 'DispositivoController@insertDispositivo');
Route::get('/dispositivo', 'DispositivoController@getDispositivo');
