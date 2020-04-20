<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden_venta extends Model
{
    protected $table = 'orden_venta';
    protected $primaryKey = 'id_orden_venta';
    public $timestamps = false;
    protected $guarded = [];

    public function detallesFormaPago()
    {
        return $this->hasMany(Detalle_forma_pago::class, 'id_orden_venta');
    }

    public function detallesOrdenVenta()
    {
        return $this->hasMany(Detalle_orden_venta::class, 'id_orden_venta');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'id_documento');
    }
}
