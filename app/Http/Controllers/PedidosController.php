<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Solicitante;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.all_pedidos.index', compact('allPedidos', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Pedidos::class);

        $applicants = Solicitante::pluck('nombre', 'id');

        return view('app.all_pedidos.create', compact('applicants'));
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

        return redirect()
            ->route('all-pedidos.edit', $pedidos)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pedidos $pedidos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pedidos $pedidos)
    {
        $this->authorize('view', $pedidos);

        return view('app.all_pedidos.show', compact('pedidos'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pedidos $pedidos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pedidos $pedidos)
    {
        $this->authorize('update', $pedidos);

        $applicants = Solicitante::pluck('nombre', 'id');

        return view('app.all_pedidos.edit', compact('pedidos', 'applicants'));
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

        return redirect()
            ->route('all-pedidos.edit', $pedidos)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('all-pedidos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
