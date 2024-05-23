<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ViajeController extends Controller
{
    public function index()
    {
        $viajes = Viaje::with('paquete', 'cliente')->get();

        return response()->json(['viajes' => $viajes]);
    }

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
            $viaje = Viaje::create($request->all());
            return response()->json(['viaje' => $viaje], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error saving viaje', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $viaje = Viaje::with(['cliente', 'paquete'])->find($id);
        if (!$viaje) {
            return response()->json(['message' => 'Viaje not found'], 404);
        }
        return response()->json(['viaje' => $viaje]);
    }

    public function update(Request $request, $id)
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
            $viaje = Viaje::find($id);
            if (!$viaje) {
                return response()->json(['message' => 'Viaje not found'], 404);
            }

            $viaje->update($request->all());
            return response()->json(['viaje' => $viaje]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating viaje', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $viaje = Viaje::find($id);
        if (!$viaje) {
            return response()->json(['message' => 'Viaje not found'], 404);
        }

        $viaje->delete();
        return response()->json(['message' => 'Viaje deleted successfully']);
    }
}
