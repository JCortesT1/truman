<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentNumberToOrdenVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_venta', function (Blueprint $table) {
            $table->integer('numero_documento')->after('fecha_documento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orden_venta', function (Blueprint $table) {
            $table->dropColumn('numero_documento');
        });
    }
}
