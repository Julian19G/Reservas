<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Paquete;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paquetes = Paquete::all();
        return json_encode(['paquetes' => $paquetes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $paquete = new Paquete();
        $paquete->nombre = $request->nombre;
        $paquete->precio = $request->precio;
        $paquete->destino = $request->destino;
        $paquete->duracion = $request->duracion;
        $paquete->disponibilidad = $request->disponibilidad;
        $paquete->save();

        return json_encode(['paquete' => $paquete]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paquete = Paquete::find($id);

        return json_encode(['paquete' => $paquete]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paquete = Paquete::find($id);

        $paquete->nombre = $request->nombre;
        $paquete->precio = $request->precio;
        $paquete->destino = $request->destino;
        $paquete->duracion = $request->duracion;
        $paquete->disponibilidad = $request->disponibilidad;

        $paquete->save();

        return json_encode(['paquete' => $paquete]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paquete = Paquete::find($id);
        $paquete->delete();

        return json_encode(['success' => true]);
    }
}
