<?php

namespace App\Http\Controllers\Api;

use App\Models\Solicitante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IngresoResource;
use App\Http\Resources\IngresoCollection;

class SolicitanteIngresosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Solicitante $solicitante
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Solicitante $solicitante)
    {
        $this->authorize('view', $solicitante);

        $search = $request->get('search', '');

        $ingresos = $solicitante
            ->incomes()
            ->search($search)
            ->latest()
            ->paginate();

        return new IngresoCollection($ingresos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Solicitante $solicitante
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Solicitante $solicitante)
    {
        $this->authorize('create', Ingreso::class);

        $validated = $request->validate([
            'empresa' => ['nullable', 'max:255', 'string'],
            'comprobante_ingresos' => [
                'nullable',
                'in:recibos de nómina,recibo de pago por honorarios,recibo de pago por arrendamiento,movimiento de cuenta de ahorro,otro',
            ],
            'salario_bruto' => ['nullable', 'max:9'],
            'salario_neto' => ['nullable', 'max:9'],
            'tipo_empleo' => ['nullable', 'in:formal,informal,otro'],
            'fecha_contratacion' => ['nullable', 'date'],
        ]);

        $ingreso = $solicitante->incomes()->create($validated);

        return new IngresoResource($ingreso);
    }
}
