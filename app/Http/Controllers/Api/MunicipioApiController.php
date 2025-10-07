<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioApiController extends Controller
{
    /**
     * GET /api/v1/municipios
     * Filtros: search
     * Orden: sort (municipio|id_municipio), dir (asc|desc)
     * Paginación: per_page (<=100), page
     */
    public function index(Request $req)
    {
        $q = Municipio::query()
            ->when($req->filled('search'), function ($qq) use ($req) {
                $s = $req->search;
                $qq->where('municipio', 'like', "%$s%");
            });

        $sortAllowed = ['id_municipio','municipio'];
        $sort = in_array($req->get('sort'), $sortAllowed, true) ? $req->get('sort') : 'municipio';
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
     * GET /api/v1/municipios/{id}
     */
    public function show(string $id)
    {
        $municipio = Municipio::findOrFail($id);
        return response()->json(['data' => $municipio]);
    }

    /**
     * POST /api/v1/municipios
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'municipio' => 'required|string|max:100|unique:municipios,municipio',
        ]);

        $m = Municipio::create($validated);
        return response()->json(['data' => $m], 201);
    }

    /**
     * PATCH /api/v1/municipios/{id}
     */
    public function update(Request $request, string $id)
    {
        $m = Municipio::findOrFail($id);

        $validated = $request->validate([
            'municipio' => 'required|string|max:100|unique:municipios,municipio,' . $m->id_municipio . ',id_municipio',
        ]);

        $m->update($validated);
        return response()->json(['data' => $m->fresh()]);
    }

    /**
     * DELETE /api/v1/municipios/{id}
     */
    public function destroy(string $id)
    {
        $m = Municipio::findOrFail($id);
        $m->delete();
        return response()->json(['message' => 'Municipio eliminado correctamente.']);
    }
}
