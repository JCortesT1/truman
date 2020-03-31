<?php

namespace App;

use App\Author;
use App\Editorial;
use App\Subfamily;
use App\Topic;
use App\Unit;
use App\Cellar;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'id_producto';

    public function author()
    {
        return $this->belongsTo(Author::class, 'id_autor');
    }

    public function editorial()
    {
        return $this->belongsTo(Editorial::class, 'id_editorial');
    }

    public function subFamily()
    {
        return $this->belongsTo(Subfamily::class, 'id_subfamilia');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'id_tema');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unidad');
    }

    public function cellars()
    {
        return $this->belongsToMany('App\Cellar', 'inventario', 'id_producto', 'id_bodega')->withPivot('stock_actual');
    }
}
