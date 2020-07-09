<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Proveedor extends Model
{
    protected $table = 'cliente_proveedor';
    protected $primaryKey = 'id_cliente_proveedor';
    protected $guarded = [];
    public $timestamps = false;
}
