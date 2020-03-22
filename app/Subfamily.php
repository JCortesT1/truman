<?php

namespace App;

use App\Product;
use App\Family;
use Illuminate\Database\Eloquent\Model;

class Subfamily extends Model
{
    protected $table = 'subfamilia';
    protected $primaryKey = 'id_subfamilia';

    public function products()
    {
        return $this->hasMany(Product::class, 'id_subfamilia');
    }

    public function family()
    {
        return $this->belongsTo(Family::class, 'id_familia');
    }
}
