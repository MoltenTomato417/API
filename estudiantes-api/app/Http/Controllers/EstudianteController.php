<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Estudiante::all());
    }

    public function store(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'nombre'   => 'required|string|max:255',
            'correo'   => 'required|email|max:255|unique:estudiantes,correo',
            'programa' => 'required|string|max:255',
        ]);

        return response()->json(Estudiante::create($datos), 201);
    }

    public function show(int $id): JsonResponse
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        return response()->json($estudiante);
    }
}