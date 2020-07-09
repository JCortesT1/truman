<?php

namespace App\Http\Controllers;

use App\Detalle_forma_pago;
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

    public function updateDocument(Request $request, int $id)
    {
        $detalle_forma_pago = Detalle_forma_pago::find($id);
        $detalle_forma_pago->id_forma_pago = $request->input('forma-pago-nueva');
        $detalle_forma_pago->save();

        $fecha = substr($detalle_forma_pago->ordenVenta->fecha_documento, 0, 8);

        return redirect()->route('orden_ventas.close', [$fecha])->with('status', 'El documento fue actualizado');
    }
}
