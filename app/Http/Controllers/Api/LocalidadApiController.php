<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Localidad;
use App\Models\Municipio;
use Illuminate\Http\Request;

class LocalidadApiController extends Controller
{
    /**
     * GET /api/v1/localidades
     * Filtros: search, municipio_id
     * Orden: sort (localidad|id_localidad), dir (asc|desc)
     * Paginación: per_page (<=100), page
     */
    public function index(Request $req)
    {
        $q = Localidad::query()
            ->with('municipio')
            ->when($req->filled('municipio_id'), fn($qq) => $qq->where('id_municipio', $req->municipio_id))
            ->when($req->filled('search'), function ($qq) use ($req) {
                $s = $req->search;
                $qq->where('localidad', 'like', "%$s%");
            });

        $sortAllowed = ['id_localidad','localidad'];
        $sort = in_array($req->get('sort'), $sortAllowed, true) ? $req->get('sort') : 'localidad';
        $dir  = $req->get('dir') === 'desc' ? 'desc' : 'asc';
        $q->orderBy($sort, $dir);

        $perPage = min((int) $req->get('per_page', 25), 100);
        $data = $q->paginate($perPage);

        return response()->json([
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'per_page'     => $data->perPage(),
                'total'        => $data->total(),
                'last_page'    => $data->lastPage(),
                'sort'         => $sort,
                'dir'          => $dir,
            ],
        ]);
    }

    /**
     * GET /api/v1/localidades/{id}
     */
    public function show(string $id)
    {
        $loc = Localidad::with('municipio')->findOrFail($id);
        return response()->json(['data' => $loc]);
    }

    /**
     * POST /api/v1/localidades
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'localidad'    => 'required|string|max:255|unique:localidades,localidad',
            'id_municipio' => 'required|exists:municipios,id_municipio',
        ]);

        $loc = Localidad::create($validated)->load('municipio');
        return response()->json(['data' => $loc], 201);
    }

    /**
     * PATCH /api/v1/localidades/{id}
     */
    public function update(Request $request, string $id)
    {
        $loc = Localidad::findOrFail($id);

        $validated = $request->validate([
            'localidad'    => 'required|string|max:255|unique:localidades,localidad,' . $loc->id_localidad . ',id_localidad',
            'id_municipio' => 'required|exists:municipios,id_municipio',
        ]);

        $loc->update($validated);
        return response()->json(['data' => $loc->fresh()->load('municipio')]);
    }

    /**
     * DELETE /api/v1/localidades/{id}
     */
    public function destroy(string $id)
    {
        $loc = Localidad::findOrFail($id);
        $loc->delete();

        return response()->json(['message' => 'Localidad eliminada correctamente.']);
    }

    /**
     * GET /api/v1/municipios/{id}/localidades
     * Lista localidades pertenecientes a un municipio.
     */
    public function byMunicipio(string $id)
    {
        // valida existencia del municipio (opcional)
        Municipio::findOrFail($id);

        $localidades = Localidad::where('id_municipio', $id)
            ->orderBy('localidad')
            ->get(['id_localidad as id','localidad']);

        return response()->json(['data' => $localidades]);
    }
}
