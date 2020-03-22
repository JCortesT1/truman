<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unidad';
    protected $primaryKey = 'id_unidad';

    public function products()
    {
        return $this->hasMany(Product::class, 'id_unidad');
    }
}
