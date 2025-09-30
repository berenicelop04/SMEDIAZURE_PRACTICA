<?php

namespace App\Http\Controllers;

use App\Models\ReportePrincipal;
use App\Models\Subreporte;
use Illuminate\Http\Request;

class SubreporteController extends Controller
{
    public function store(Request $request, ReportePrincipal $reporte)
    {
        // No se permiten subreportes si el principal está finalizado
        if ($reporte->estado === 'finalizado') {
            abort(403, 'El reporte está finalizado y no admite más subreportes.');
        }

        // (Opcional) Solo el técnico asignado puede crear subreportes
        if (auth()->id() !== (int) $reporte->tecnico_id) {
            abort(403, 'No autorizado.');
        }

        $data = $request->validate([
            'descripcion_tecnico' => 'required|string',
            'solucion'            => 'nullable|string',
            'fecha_visita'        => 'required|date',
            'estado_after'        => 'required|in:pendiente,en_proceso,finalizado',
        ]);

        $sub = Subreporte::create([
            'reporte_principal_id' => $reporte->id,
            'tecnico_id'           => auth()->id(),
            'descripcion_tecnico'  => $data['descripcion_tecnico'],
            'solucion'             => $data['solucion'] ?? null,
            'fecha_visita'         => $data['fecha_visita'],
            'estado_after'         => $data['estado_after'],
        ]);

        // Si con este subreporte se finaliza, cerrar el principal
        if ($data['estado_after'] === 'finalizado') {
            $reporte->update([
                'estado' => 'finalizado',
                'fecha_finalizacion' => now(),
            ]);
        } else {
            // Caso contrario, mantener estado coherente
            if ($reporte->estado === 'pendiente') {
                $reporte->update(['estado' => 'en_proceso']);
            }
        }

        return back()->with('success', 'Subreporte registrado.')->with('subreporte_id', $sub->id);
    }
}

