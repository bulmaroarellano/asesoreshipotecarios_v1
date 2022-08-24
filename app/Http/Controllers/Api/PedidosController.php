<?php

namespace App\Http\Controllers\Api;

use App\Models\Pedidos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PedidosResource;
use App\Http\Resources\PedidosCollection;
use App\Http\Requests\PedidosStoreRequest;
use App\Http\Requests\PedidosUpdateRequest;

class PedidosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Pedidos::class);

        $search = $request->get('search', '');

        $allPedidos = Pedidos::search($search)
            ->latest()
            ->paginate();

        return new PedidosCollection($allPedidos);
    }

    /**
     * @param \App\Http\Requests\PedidosStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PedidosStoreRequest $request)
    {
        $this->authorize('create', Pedidos::class);

        $validated = $request->validated();

        $pedidos = Pedidos::create($validated);

        return new PedidosResource($pedidos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pedidos $pedidos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pedidos $pedidos)
    {
        $this->authorize('view', $pedidos);

        return new PedidosResource($pedidos);
    }

    /**
     * @param \App\Http\Requests\PedidosUpdateRequest $request
     * @param \App\Models\Pedidos $pedidos
     * @return \Illuminate\Http\Response
     */
    public function update(PedidosUpdateRequest $request, Pedidos $pedidos)
    {
        $this->authorize('update', $pedidos);

        $validated = $request->validated();

        $pedidos->update($validated);

        return new PedidosResource($pedidos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pedidos $pedidos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pedidos $pedidos)
    {
        $this->authorize('delete', $pedidos);

        $pedidos->delete();

        return response()->noContent();
    }
}
