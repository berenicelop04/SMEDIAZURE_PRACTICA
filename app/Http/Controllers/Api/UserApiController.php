<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserApiController extends Controller
{
    /**
     * Obtener todos los usuarios con su rol.
     */
    public function index()
    {
        // Obtener todos los usuarios con su rol (eager loading)
        $users = User::with('role')->get();

        // Retornar la respuesta en formato JSON
        return response()->json([
            'data' => $users
        ]);
    }

    /**
     * Obtener un usuario específico por su ID.
     */
    public function show($id)
    {
        // Buscar el usuario por su ID y cargar su rol
        $user = User::with('role')->findOrFail($id);

        // Retornar la respuesta en formato JSON
        return response()->json([
            'data' => $user
        ]);
    }
}
