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
        $promociones = Promocion::with('paquete')->get();
        return response()->json(['promociones' => $promociones]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_paquete' => 'required|exists:paquetes,id',
            'descuento' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
    
        $promocion = new Promocion();
        $promocion->id_paquete = $validatedData['id_paquete'];
        $promocion->descuento = $validatedData['descuento'];
        $promocion->fecha_inicio = $validatedData['fecha_inicio'];
        $promocion->fecha_fin = $validatedData['fecha_fin'];
        $promocion->save();
    
        return response()->json(['promocion' => $promocion]);
    }

    public function show(string $id)
    {
        $promocion = Promocion::with('paquete')->find($id);
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
