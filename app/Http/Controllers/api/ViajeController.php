<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ViajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
  $viajes = DB::table('viajes')->get();
  return response()->json(['viajes' => $viajes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_paquete' => 'required|integer',
            'id_cliente' => 'required|integer',
            'fecha_reserva' => 'required|date',
            'cantidad_personas' => 'required|numeric',
            'total' => 'required|numeric',
            'estado' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        try {
            $viaje = new Viaje();
            $viaje->id_paquete = $request->id_paquete;
            $viaje->id_cliente = $request->id_cliente;
            $viaje->fecha_reserva = $request->fecha_reserva;
            $viaje->cantidad_personas = $request->cantidad_personas;
            $viaje->total = $request->total;
            $viaje->estado = $request->estado;
            $viaje->save();
            return response()->json(['viaje' => $viaje], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error saving payment', 'error' => $e->getMessage()], 500);
        }



        return json_encode(['$viaje' => $viaje]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $viaje = Viaje::find($id);
        $cliente = DB::table('clientes')
        ->where('id', $viaje->id_cliente)
        ->first();
    $paquete = DB::table('paquetes')
        ->where('id', $viaje->id_paquete)
        ->first();
        return json_encode(['viaje' => $viaje, 'clientes' => $clientes, 'paquetes' => $paquetes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $viaje = Viaje::find($id);
        $viaje->id = $request->id;
        $viaje->id_paquete = $request->id_paquete;
        $viaje->id_cliente = $request->id_cliente;
        $viaje->fecha_reserva = $request->fecha_reserva;
        $viaje->cantidad_personas = $request->cantidad_personas;
        $viaje->total = $request->total;
        $viaje->estado = $request->estado;
        $viaje->save();
        return json_encode(['$viaje' => $viaje]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $viaje = Viaje::find($id);
        $viaje->delete();

        $viajes = DB::table('viajes')
        ->join('paquetes', 'viajes.id_paquete', '=', 'paquetes.id')
        ->join('clientes', 'viajes.id_cliente', '=', 'clientes.id')
        ->select('viajes.*','clientes.nombre',  'paquetes.nombre')
        ->get();

        return json_encode(['viajes' => $viajes, 'success' => true]);
    }
}
