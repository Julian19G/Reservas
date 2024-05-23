<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pagos = DB::table('pagos')->get();
        return response()->json(['pagos' => $pagos]);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pago = Pago::find($id);
        $viajes = DB::table('viajes')
            ->orderBy('nombre')
            ->get();
        return json_encode(['pago' => $pago, 'viajes' => $viajes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pago = Pago::find($id);
        $pago->id = $request->id;
        $pago->id_viaje = $request->id_viaje;
        $pago->fecha_pago = $request->fecha_pago;
        $pago->metodo_pago = $request->metodo_pago;
        $pago->save();
        return json_encode(['$pago' => $pago]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pago = Pago::find($id);
        $pago->delete();

            $pagos = DB::table('pagos')
            ->join('viajes', 'pagos.id_viaje', '=', 'viajes.id')
            ->select('pagos.*', 'viaje.nombre')
            ->get();

        return json_encode(['pagos' => $pagos, 'success' => true]);
    }
}
