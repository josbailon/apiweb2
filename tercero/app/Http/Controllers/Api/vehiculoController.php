<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Validator;

class vehiculoController extends Controller
{

    public function index(){
        $vehiculos = Vehiculo::all();
        $data = [
            'vehiculos' => $vehiculos,
            'status' => '200',
        ];
        return response()->json($data, 200);
    }
    // store es un método para guardar
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'marca' => 'required',
            'modelo' => 'required',
            'color' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => '422'
            ];
            return response()->json($data, 422);}

        $vehiculo = Vehiculo::create(
            [
                'marca' => $request->marca,
                'modelo' => $request->modelo ,   
                'color' => $request->color
            ]
        );

        if (!$vehiculo) {
            $data = [
                'message' => 'Error al crear el vehiculo',
                'status' => '500'
            ];
            return response()->json($data, 500);
        }

        $data = [
            'vehiculo' => $vehiculo,
            'status' => '201'
        ];

        return response()->json($data, 201);
    }
// show es un método para mostrar un cliente
public function show($id){
    $vehiculos = Vehiculo::find($id);
    if (!$vehiculos) {
        $data = [
            'message' => 'Vehiculo no encontrado',
            'status' => '404'
        ];
        return response()->json($data, 404);
    }

    $data = [
        'vehiculo' => $vehiculos,
        'status' => '200'
    ];

    return response()->json($data, 200);

}

//destroy es un método para eliminar un vehiculo
public function destroy($id){
    $vehiculos = Vehiculo::find($id);
    if (!$vehiculos) {
        $data = [
            'message' => 'Vehiculo no encontrado',
            'status' => '404'
        ];
        return response()->json($data, 404);
    }

    $vehiculos->delete();
    $data = [
        'message' => 'Vehiculo eliminado',
        'status' => '200'
    ];

    return response()->json($data, 200);

}
//update
public function update(Request $request, $id){
    $vehiculo = Vehiculo::find($id);
    if (!$vehiculo) {
        $data = [
            'message' => 'Vehiculo no encontrado',
            'status' => '404'
        ];
        return response()->json($data, 404);
    }

    $validator = Validator::make($request->all(), [
        'marca' => 'required',
        'modelo' => 'required',
        'color' => 'required',
    ]);

    if ($validator->fails()) {
        $data = [
            'message' => 'Error en la validación de los datos',
            'errors' => $validator->errors(),
            'status' => '422'
        ];
        return response()->json($data, 422);
    }

    $vehiculo->marca = $request->marca;
    $vehiculo->modelo = $request->modelo;
    $vehiculo->color = $request->color;
    $vehiculo->save();

    $data = [
        'vehiculo' => $vehiculo,
        'status' => '200'
    ];

    return response()->json($data, 200);
}

public function updatePartial(Request $request, $id)
{
    $vehiculo = Vehiculo::find($id);
    if (!$vehiculo) {
        $data = [
            'message' => 'Vehiculo no encontrado',
            'status' => '404'
        ];
        return response()->json($data, 404);
    }

    $validator = Validator::make($request->all(), [
        'marca' => 'sometimes|max:255',
        'modelo' => 'sometimes|max:255',
        'color' => 'sometimes|max:255',
    ]);

    if ($validator->fails()) {
        $data = [
            'message' => 'Error en la validación de los datos',
            'errors' => $validator->errors(),
            'status' => '422'
        ];
        return response()->json($data, 422);
    }

    if ($request->has('marca')) {
        $vehiculo->marca = $request->marca;
    }

    if ($request->has('modelo')) {
        $vehiculo->modelo = $request->modelo;
    }

    if ($request->has('color')) {
        $vehiculo->color = $request->color;
    }

    $vehiculo->save();

    $data = [
        'message' => 'Vehiculo actualizado parcialmente',
        'vehiculo' => $vehiculo,
        'status' => '200'
    ];

    return response()->json($data, 200);
}


}

