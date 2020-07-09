<?php

namespace App\Http\Controllers;

use App\Cliente_Proveedor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clientes = Cliente_Proveedor::where('id_cliente_proveedor','<>', 0)->orderby('nombre')->get();
        return view('home.home', compact('clientes'));
    }
}
