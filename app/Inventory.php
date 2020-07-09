<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventario';
    protected $primaryKey = 'id_inventario';
    protected $guarded = [];
    public $timestamps = false;
}
