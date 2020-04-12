<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_forma_pago extends Model
{
    protected $table = 'detalle_forma_pago';
    protected $primaryKey = 'id_detalle_forma_pago';
    protected $guarded = [];
    public $timestamps = false;

    public function ordenVenta()
    {
        return $this->belongsTo(Orden_venta::class, 'id_orden_venta');
    }

    public function formaPago()
    {
        return $this->belongsTo(Forma_pago::class, 'id_forma_pago');
    }
}
