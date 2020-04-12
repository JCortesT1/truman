<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleFormaPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_forma_pago', function (Blueprint $table) {
            $table->id('id_detalle_forma_pago');
            $table->integer('id_orden_venta')->unsigned();
            $table->integer('id_forma_pago')->unsigned();
            $table->double('monto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_forma_pago');
    }
}
