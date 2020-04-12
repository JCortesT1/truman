<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function getDocuments()
    {
        return DB::table('documento')->where('venta_pos', 1)->orderBy('nombre_corto')->get();
    }

    public function getPayMethods()
    {
        return DB::table('forma_pago')->get();
    }
}
