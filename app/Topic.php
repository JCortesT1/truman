<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'tema';
    protected $primaryKey = 'id_tema';

    public function products()
    {
        return $this->hasMany(Product::class, 'id_tema');
    }
}
