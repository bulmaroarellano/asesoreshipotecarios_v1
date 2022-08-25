<?php

namespace App\Http\Controllers\Api;

use App\Models\Solicitante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PedidosResource;
use App\Http\Resources\PedidosCollection;

class SolicitanteAllPedidosController extends Controller
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

        $allPedidos = $solicitante
            ->transactions()
            ->search($search)
            ->latest()
            ->paginate();

        return new PedidosCollection($allPedidos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Solicitante $solicitante
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Solicitante $solicitante)
    {
        $this->authorize('create', Pedidos::class);

        $validated = $request->validate([
            'folio' => ['required', 'unique:pedidos,folio', 'max:8', 'string'],
            'destino' => [
                'required',
                'in:casa,auto,prestamo,tarjeta de credito',
            ],
            'monto_solicitado' => ['required', 'max:255', 'string'],
            'plazo' => ['required', 'max:2'],
        ]);

        $pedidos = $solicitante->transactions()->create($validated);

        return new PedidosResource($pedidos);
    }
}
