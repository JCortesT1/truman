<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_orden_venta extends Model
{
    protected $table = 'detalle_orden_venta';
    protected $primaryKey = 'id_detalle_orden_venta';
    protected $guarded = [];
    public $timestamps = false;

    public function ordenVenta()
    {
        return $this->belongsTo(Orden_venta::class, 'id_orden_venta');
    }
}
