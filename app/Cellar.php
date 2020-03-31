<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cellar extends Model
{
    protected $table = 'bodega';
    protected $primaryKey = 'id_bodega';

    public function products()
    {
        return $this->belongsToMany('App\Product', 'inventario', 'id_bodega', 'id_producto')->withPivot('stock_actual');
    }
}
