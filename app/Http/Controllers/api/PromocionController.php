<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Promocion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    public function index()
    {
        $promociones = DB::table('promociones')
            ->join('paquetes', 'promociones.id_paquete', '=', 'paquetes.id')
            ->select('promociones.*', 'paquetes.id as paquete_id')
            ->get();

        return response()->json(['promociones' => $promociones]);
    }

    public function store(Request $request)
    {
        $promocion = new Promocion();
        $promocion->id_paquete = $request->id_paquete;
        $promocion->descuento = $request->descuento;
        $promocion->fecha_inicio = $request->fecha_inicio;
        $promocion->fecha_fin = $request->fecha_fin;
        $promocion->save();

        return response()->json(['promocion' => $promocion]);
    }

    public function show(string $id)
    {
        $promocion = Promocion::find($id);
        $paquetes = DB::table('paquetes')->orderBy('nombre')->get();

        return response()->json(['promocion' => $promocion, 'paquetes' => $paquetes]);
    }

    public function update(Request $request, string $id)
    {
        $promocion = Promocion::find($id);
        $promocion->id_paquete = $request->id_paquete;
        $promocion->descuento = $request->descuento;
        $promocion->fecha_inicio = $request->fecha_inicio;
        $promocion->fecha_fin = $request->fecha_fin;
        $promocion->save();

        return response()->json(['promocion' => $promocion]);
    }

    public function destroy(string $id)
    {
        $promocion = Promocion::find($id);
        $promocion->delete();

        $promociones = DB::table('promociones')
            ->join('paquetes', 'promociones.id_paquete', '=', 'paquetes.id')
            ->select('promociones.*', 'paquetes.id as paquete_id')
            ->get();

        return response()->json(['promociones' => $promociones, 'success' => true]);
    }
}
