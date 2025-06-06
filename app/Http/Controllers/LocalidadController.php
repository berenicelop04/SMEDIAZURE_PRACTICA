<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use App\Models\Municipio;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    public function index()
    {
        $localidades = Localidad::with('municipio')->get();
        return view('localidades.index', compact('localidades'));
    }

    public function create()
    {
        $municipios = Municipio::all();
        return view('localidades.create', compact('municipios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'localidad' => 'required|string|max:255',
            'id_municipio' => 'required|exists:municipios,id_municipio',
        ]);

        Localidad::create($request->all());

        return redirect()->route('localidades.index')->with('success', 'Localidad creada correctamente.');
    }

    public function edit($id)
    {
        $localidad = Localidad::findOrFail($id);
        $municipios = Municipio::all();
        return view('localidades.edit', compact('localidad', 'municipios'));
    }

    public function update(Request $request, $id)
    {
        $localidad = Localidad::findOrFail($id);

        $request->validate([
            'localidad' => 'required|string|max:255',
            'id_municipio' => 'required|exists:municipios,id_municipio',
        ]);

        $localidad->update($request->all());

        return redirect()->route('localidades.index')->with('success', 'Localidad actualizada correctamente.');
    }

    public function destroy($id)
    {
        Localidad::destroy($id);
        return redirect()->route('localidades.index')->with('success', 'Localidad eliminada.');
    }
}
