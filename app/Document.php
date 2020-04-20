<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documento';
    protected $primaryKey = 'id_documento';

    public function ordenVenta()
    {
        return $this->hasMany(Orden_venta::class, 'id_documento');
    }
}
