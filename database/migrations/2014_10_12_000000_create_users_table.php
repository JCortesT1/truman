<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('modo')->default(0);
            $table->string('rut');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('celular')->default(0);
            $table->integer('role_id')->unsigned()->nullable();
            $table->integer('sucursal_id')->unsigned()->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->integer('habilitado')->default(1);
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
        Schema::dropIfExists('users');
    }
}
