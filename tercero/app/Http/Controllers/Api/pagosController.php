<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pagos;
use Illuminate\Support\Facades\Validator;

class PagosController extends Controller
{
    public function index()
    {
        $pagos = Pagos::all();
        return response()->json(['pagos' => $pagos], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'monto' => 'required|numeric|min:0',
            'comentario' => 'nullable|string',
            'tipo' => 'required|in:efectivo,tarjeta,transferencia',
            'estado' => 'required|in:pendiente,pagado',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $pago = Pagos::create($request->all());

        return response()->json(['pago' => $pago], 201);
    }

    public function show($id)
    {
        $pago = Pagos::find($id);

        if (!$pago) {
            return response()->json(['error' => 'Pago not found'], 404);
        }

        return response()->json(['pago' => $pago], 200);
    }

    public function update(Request $request, $id)
    {
        $pago = Pagos::find($id);

        if (!$pago) {
            return response()->json(['error' => 'Pago not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'fecha' => 'date',
            'monto' => 'numeric|min:0',
            'comentario' => 'nullable|string',
            'tipo' => 'in:efectivo,tarjeta,transferencia',
            'estado' => 'in:pendiente,pagado',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $pago->update($request->all());

        return response()->json(['pago' => $pago], 200);
    }

    public function destroy($id)
    {
        $pago = Pagos::find($id);

        if (!$pago) {
            return response()->json(['error' => 'Pago not found'], 404);
        }

        $pago->delete();

        return response()->json(['message' => 'Pago deleted'], 200);
    }
}
