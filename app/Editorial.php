<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    protected $table = 'editorial';
    protected $primaryKey = 'id_editorial';

    public function products()
    {
        return $this->hasMany(Product::class, 'id_editorial');
    }
}
