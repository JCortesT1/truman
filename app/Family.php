<?php

namespace App;

use App\Subfamily;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $table = 'familia';
    protected $primaryKey = 'id_familia';

    public function subfamilies()
    {
        return $this->hasMany(Subfamily::class, 'id_familia');
    }
}
