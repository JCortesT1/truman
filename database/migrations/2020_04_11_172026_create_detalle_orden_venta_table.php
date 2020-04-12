<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleOrdenVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_orden_venta', function (Blueprint $table) {
            $table->id('id_detalle_orden_venta');
            $table->integer('id_orden_venta')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->double('precio_unitario');
            $table->double('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_orden_venta');
    }
}
