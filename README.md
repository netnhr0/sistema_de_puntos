
El script de la base de datos se llama sistema_de_puntos.sql

## Metodos

En la Clase controladora VentaController hice los siguientes metodos:
 * code_segurity() para generar el codigo seguro de forma automatica.
 * puntosComercio($operacion, $rut) para sumar o restar los punto por cada venta o anulacion que realiza el comercio, se recibe 2 parametros de entrada que es la operacion, que seria si vendio o anular para hacer la respectiva operacion(sumar o restar) y el rut es para realizar el update correspondiente a los puntos que obtenga el comercio.
 * insertVenta() se ingresa la venta a la base de datos y este genera un json para ver los datos ingresados y visualizar el codigo de seguridad, aqui realice un hash para almacenarlo en la base de datos.
 * anularVenta() aqui es donde realizo el update a estado donde este es un boolean, es para saber que lo anularon o cancelaron la venta.
 * getVentas() para saber todas las venta que han realizado
 * getVentasRut($rut) para saber cuantas ventas hizo el rut señalado.

 En los demas Controladores realice el metodo insert y get, para insertar mas datos y visualizarlos.

## Rutas

Se presenta las rutas para poder usar la API, estas estan por metodos GET y POST. se va a señalar cual corresponde usar:

* POST: [direccion servidor]/api/venta/insert         : key[rut, id_dispositivo, monto]
* POST: [direccion servidor]/api/venta/cancelar       : key[id_venta, codigo_seguridad]
* GET:  [direccion servidor]/api/venta

* GET:  [direccion servidor]/api/comercio
* POST: [direccion servidor]/api/comercio/insert      : key[rut, nombre]
* GET:  [direccion servidor]/api/comercio/rut/{rut}

* POST: [direccion servidor]/api/dispositivo/insert   : key[id_dispositivo, nombre]
* GET:  [direccion servidor]/api/dispositivo

## Datos

Los Datos que estan en la Base de Datos se ocuparon solo para realizar las pruebas:

Comercios (rut(PK), nombre, puntos):
-1111111-1, Evaluacion
-2222222-2, Junior
-3333333-3, Laravel 7
-9999999-9, Persona X

Dispositivos (id_dispositivo(PK), nombre):
-10001, Maquina POS
-10002, Pistola codigo Barra
-10003, Punto de Venta
-10004, Hosting Web

Ventas (id_venta, rut, id_dispositivo, monto, codigo_seguridad, estado): Aqui señalo el id_venta y codigo_seguridad
-1,7018663274
-4,5626680702
-6,4557314560
