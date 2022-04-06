<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id_venta');
            $table->string('rut');
            $table->unsignedBigInteger('id_dispositivo');
            $table->integer('monto');
            $table->string('codigo_seguridad');
            $table->boolean('estado');
            $table->foreign('rut')->references('rut')->on('comercios');
            $table->foreign('id_dispositivo')->references('id_dispositivo')->on('dispositivos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
