<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'autor';
    protected $primaryKey = 'id_autor';

    public function products()
    {
        return $this->hasMany(Product::class, 'id_autor');
    }
}
