<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UbicacionAntena;
use App\Models\Localidad;
use App\Models\Municipio;
use App\Models\EstadoEnergia;
use App\Models\Dispositivo;
use Illuminate\Http\Request;

class UbicacionAntenaApiController extends Controller
{
    /**
     * GET /api/v1/antenas
     * Filtros: search, localidad_id, municipio_id, estado_energia_id, dispositivo_id
     * Orden:   sort (ip|latitud|longitud|id_antena), dir (asc|desc)
     * Paginación: per_page (<= 100), page
     */
    public function index(Request $req)
    {
        $q = UbicacionAntena::query()
            ->with(['localidad', 'municipio', 'estadoEnergia', 'dispositivo'])
            ->when($req->filled('localidad_id'), fn($qq) => $qq->where('id_localidad', $req->localidad_id))
            ->when($req->filled('municipio_id'), fn($qq) => $qq->where('id_municipio', $req->municipio_id))
            ->when($req->filled('estado_energia_id'), fn($qq) => $qq->where('id_estado_energia', $req->estado_energia_id))
            ->when($req->filled('dispositivo_id'), fn($qq) => $qq->where('id_dispositivo', $req->dispositivo_id))
            ->when($req->filled('search'), function ($qq) use ($req) {
                $s = $req->search;
                $qq->where(function ($w) use ($s) {
                    $w->where('ip', 'like', "%$s%")
                      ->orWhere('latitud', 'like', "%$s%")
                      ->orWhere('longitud', 'like', "%$s%");
                });
            });

        $sortAllowed = ['id_antena','ip','latitud','longitud'];
        $sort = in_array($req->get('sort'), $sortAllowed, true) ? $req->get('sort') : 'id_antena';
        $dir  = $req->get('dir') === 'asc' ? 'asc' : 'desc';
        $q->orderBy($sort, $dir);

        $perPage = min((int) $req->get('per_page', 15), 100);
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
            ]
        ]);
    }

    /**
     * GET /api/v1/antenas/{id}
     */
    public function show(string $id)
    {
        $antena = UbicacionAntena::with(['localidad','municipio','estadoEnergia','dispositivo'])
            ->findOrFail($id);

        return response()->json(['data' => $antena]);
    }

    /**
     * POST /api/v1/antenas
     * Crea una antena. Aplica mismas validaciones que tu controlador web.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ip'               => 'required|string|max:25|unique:ubicacion_antenas,ip',
            'latitud'          => 'required|numeric',
            'longitud'         => 'required|numeric',
            'id_localidad'     => 'required|exists:localidades,id_localidad',
            'id_municipio'     => 'required|exists:municipios,id_municipio',
            'id_estado_energia'=> 'required|exists:estado_energia,id_estado_energia',
            'id_dispositivo'   => 'nullable|exists:dispositivos,id_dispositivo',
        ]);

        // Validar combinación única lat/long
        $existe = UbicacionAntena::where('latitud', $validated['latitud'])
            ->where('longitud', $validated['longitud'])
            ->exists();

        if ($existe) {
            return response()->json([
                'message' => 'Ya existe una antena en esta ubicación (latitud y longitud).'
            ], 422);
        }

        // Si no envían dispositivo, asigna 1 por defecto (como en tu web)
        if (empty($validated['id_dispositivo'])) {
            $validated['id_dispositivo'] = 1;
        }

        $antena = UbicacionAntena::create($validated)
            ->load(['localidad','municipio','estadoEnergia','dispositivo']);

        return response()->json(['data' => $antena], 201);
    }

    /**
     * PATCH /api/v1/antenas/{id}
     * Actualiza una antena.
     */
    public function update(Request $request, string $id)
    {
        $antena = UbicacionAntena::findOrFail($id);

        $validated = $request->validate([
            'ip'               => 'required|string|max:25|unique:ubicacion_antenas,ip,' . $antena->id_antena . ',id_antena',
            'latitud'          => 'required|numeric',
            'longitud'         => 'required|numeric',
            'id_localidad'     => 'required|exists:localidades,id_localidad',
            'id_municipio'     => 'required|exists:municipios,id_municipio',
            'id_estado_energia'=> 'required|exists:estado_energia,id_estado_energia',
            'id_dispositivo'   => 'nullable|exists:dispositivos,id_dispositivo',
        ]);

        // Combinación única lat/long, excluyendo la actual
        $repetida = UbicacionAntena::where('id_antena', '!=', $antena->id_antena)
            ->where('latitud', $validated['latitud'])
            ->where('longitud', $validated['longitud'])
            ->exists();

        if ($repetida) {
            return response()->json([
                'message' => 'Ya existe otra antena en esta ubicación (latitud y longitud).'
            ], 422);
        }

        // Si no mandan dispositivo, conserva el existente (no lo pisamos por 1)
        if (!array_key_exists('id_dispositivo', $validated)) {
            $validated['id_dispositivo'] = $antena->id_dispositivo;
        } elseif (empty($validated['id_dispositivo'])) {
            $validated['id_dispositivo'] = 1; // si quieres mantener el 1 como fallback
        }

        $antena->update($validated);

        return response()->json(['data' => $antena->fresh()->load(['localidad','municipio','estadoEnergia','dispositivo'])]);
    }

    /**
     * DELETE /api/v1/antenas/{id}
     */
    public function destroy(string $id)
    {
        $antena = UbicacionAntena::findOrFail($id);
        $antena->delete();

        return response()->json(['message' => 'Antena eliminada correctamente.']);
    }

    /**
     * GET /api/v1/antenas/catalogos/all
     * Devuelve catálogos para selects.
     */
    public function catalogos()
    {
        return response()->json([
            'localidades'     => Localidad::orderBy('localidad')->get(['id_localidad as id','localidad as nombre']),
            'municipios'      => Municipio::orderBy('municipio')->get(['id_municipio as id','municipio as nombre']),
            'estados_energia' => EstadoEnergia::orderBy('estado_energia')->get(['id_estado_energia as id','estado_energia as nombre']),
            'dispositivos'    => Dispositivo::orderBy('modelo')->get(['id_dispositivo as id','modelo as nombre']),
        ]);
    }
}
