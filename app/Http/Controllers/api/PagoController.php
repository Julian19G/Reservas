<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('viaje')->get();
        return response()->json(['pagos' => $pagos]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_viaje' => 'required|integer',
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric',
            'metodo_pago' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }

        try {
            $pago = new Pago();
            $pago->id_viaje = $request->id_viaje;
            $pago->fecha_pago = $request->fecha_pago;
            $pago->monto = $request->monto;
            $pago->metodo_pago = $request->metodo_pago;
            $pago->save();

            return response()->json(['pago' => $pago], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error saving payment', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        $pago = Pago::with('viaje')->find($id);
        if (!$pago) {
            return response()->json(['message' => 'Pago not found'], 404);
        }

        return response()->json(['pago' => $pago]);
    }

    public function update(Request $request, string $id)
    {
        $pago = Pago::find($id);
        if (!$pago) {
            return response()->json(['message' => 'Pago not found'], 404);
        }

        $pago->id_viaje = $request->id_viaje;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->monto = $request->monto;
        $pago->metodo_pago = $request->metodo_pago;
        $pago->save();

        return response()->json(['pago' => $pago]);
    }

    public function destroy(string $id)
    {
        $pago = Pago::find($id);
        if (!$pago) {
            return response()->json(['success' => false, 'message' => 'Pago not found'], 404);
        }
    
        $pago->delete();
        return response()->json(['success' => true, 'message' => 'Pago deleted successfully']);
    }
    
}