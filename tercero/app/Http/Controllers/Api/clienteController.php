<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index(){
        $clientes = Cliente::all();
        $data = [
            'clientes' => $clientes,
            'status' => '200',
        ];
        return response()->json($data, 200);
    }

    // store es un método para guardar
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'correo' => 'required|email|unique:cliente',
            'telefono' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => '422'
            ];
            return response()->json($data, 422);}

        $cliente = Cliente::create(
            [
                'nombre' => $request->nombre,
                'correo' => $request->correo ,   
                'telefono' => $request->telefono
            ]
        );

        if (!$cliente) {
            $data = [
                'message' => 'Error al crear el cliente',
                'status' => '500'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'cliente' => $cliente,
            'status' => '201'
        ];

        return response()->json($data, 201);
    }   
 // show es un método para mostrar un cliente
    public function show($id){
        $clientes = Cliente::find($id);
        if (!$clientes) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => '404'
            ];
            return response()->json($data, 404);
        }

        $data = [
            'cliente' => $clientes,
            'status' => '200'
        ];

        return response()->json($data, 200);
    }

    //destroy es un método para eliminar un cliente
    public function destroy($id){
        $clientes = Cliente::find($id);
        if (!$clientes) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => '404'
            ];
            return response()->json($data, 404);
        }

        $clientes->delete();
        $data = [
            'message' => 'Cliente eliminado',
            'status' => '200'
        ];

        return response()->json($data, 200);
    }
    
//update
   public function update(Request $request, $id){
        $cliente = Cliente::find($id);
        if (!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => '404'
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'correo' => 'required|email|unique:cliente',
            'telefono' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => '422'
            ];
            return response()->json($data, 422);
        }

        $cliente->nombre = $request->nombre;
        $cliente->correo = $request->correo;
        $cliente->telefono = $request->telefono;
        $cliente->save();

        $data = [
            'cliente' => $cliente,
            'status' => '200'
        ];

        return response()->json($data, 200);
    }
// pacht

    public function updatePartial(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => '404'
            ];
            return response()->json($data, 404);
        }
    
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|max:255',
            'correo' => 'sometimes|email|unique:clientes,correo,' . $cliente->id,
            'telefono' => 'sometimes|digits:10',
        ]);
    
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => '422'
            ];
            return response()->json($data, 422);
        }
    
        if ($request->has('nombre')) {
            $cliente->nombre = $request->nombre;
        }
    
        if ($request->has('correo')) {
            $cliente->correo = $request->correo;
        }
    
        if ($request->has('telefono')) {
            $cliente->telefono = $request->telefono;
        }
    
        $cliente->save();
    
        $data = [
            'message' => 'Cliente actualizado parcialmente',
            'cliente' => $cliente,
            'status' => '200'
        ];
    
        return response()->json($data, 200);
    }
    
}
