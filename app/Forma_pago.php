<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forma_pago extends Model
{
    protected $table = 'forma_pago';
    protected $primaryKey = 'id_forma_pago';

    public function detallesFormaPago()
    {
        return $this->hasMany(Detalle_forma_pago::class, 'id_detalle_forma_pago');
    }
}
