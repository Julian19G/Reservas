<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json(['clientes' => $clientes]);
    }

    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();

        return response()->json(['cliente' => $cliente], 201);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);
        return response()->json(['cliente' => $cliente]);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();

        return response()->json(['cliente' => $cliente]);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return response()->json(['success' => true]);
    }
}