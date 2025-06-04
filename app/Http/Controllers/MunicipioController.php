<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function index()
    {
        $municipios = Municipio::all(); // Obtener todos los municipios
        return view('municipio.index', compact('municipios')); // Enviar a la vista
    }
}
