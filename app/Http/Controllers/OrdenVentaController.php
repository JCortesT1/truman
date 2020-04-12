<?php

namespace App\Http\Controllers;

use App\Detalle_forma_pago;
use App\Detalle_orden_venta;
use App\Forma_pago;
use App\Orden_venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documento = DB::table('documento')->where('nombre_corto', 'like', $request->input('tipo-documento'))->first();

        $orden_venta = Orden_venta::create([
            'fecha_documento' => date('YmdHi'),
            'total_bruto' => round($request->input('total-bruto')),
            'total_neto' => round($request->input('total-neto')),
            'iva' => round($request->input('iva')),
            'total_pagado' => round($request->input('total-pagado')),
            'total_vuelto' => round($request->input('total-vuelto', 0)),
            'id_documento' => $documento->id_documento,
            'id_usuario' => auth()->user()->id
        ]);

        $forma_pagos = $request->input('forma-pago');
        $montos = $request->input('monto');
        $ids_inventarios = $request->input('id-inventario');
        $ids_productos = $request->input('id-producto');
        $cantidades = $request->input('cantidad');
        $precios_unitarios = $request->input('precio-unitario');
        $totales_libros = $request->input('total-libro');

        foreach ($forma_pagos as $key => $value) {
            $forma_pago = Forma_pago::where('nombre_corto', 'like', $value)->first();

            $detalle_forma_pago = Detalle_forma_pago::create([
                'monto' => $montos[$key]
            ]);

            $detalle_forma_pago->ordenVenta()->associate($orden_venta);
            $detalle_forma_pago->formaPago()->associate($forma_pago);
            $detalle_forma_pago->save();
        }

        foreach ($ids_productos as $key => $value) {
            $detalle_orden_venta = Detalle_orden_venta::create([
                'id_orden_venta' => $orden_venta->id_orden_venta,
                'id_producto' => $value,
                'cantidad' => $cantidades[$key],
                'precio_unitario' => round($precios_unitarios[$key]),
                'total' => round($totales_libros[$key])
            ]);

            $inventario = DB::table('inventario')->where('id_inventario', $ids_inventarios[$key])->first();
            $cantidad = $inventario->stock_actual;
            DB::table('inventario')->where('id_inventario', $ids_inventarios[$key])->update(['stock_actual' => round(($cantidad - $cantidades[$key]))]);


            DB::table('movimiento_inventario')->insert([
                'id_inventario' => $ids_inventarios[$key],
                'id_tipo_movimiento' => 4,
                'nro_documento' => $detalle_orden_venta->id_detalle_orden_venta,
                'fecha' => date('Ymd'),
                'descripcion' => 'VENTA LIBRO',
                'entrada' => 0,
                'salida' => $cantidades[$key],
                'id_usuario' => auth()->user()->id,
                'id_documento' => $documento->id_documento
            ]);
        }

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
