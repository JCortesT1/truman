<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_venta', function (Blueprint $table) {
            $table->id('id_orden_venta');
            $table->integer('id_sucursal')->unsigned();
            $table->integer('id_cliente_proveedor')->unsigned();
            $table->string('fecha_documento', 12);
            $table->double('total_bruto')->default(0);
            $table->double('total_neto')->default(0);
            $table->double('iva')->default(0);
            $table->double('total_pagado')->default(0);
            $table->double('total_vuelto')->default(0);
            $table->integer('id_documento')->unsigned();
            $table->integer('id_usuario')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_venta');
    }
}
