<?php

namespace App\Http\Controllers;

use App\Models\Solicitante;
use Illuminate\Http\Request;
use App\Http\Requests\SolicitanteStoreRequest;
use App\Http\Requests\SolicitanteUpdateRequest;

class SolicitanteController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Solicitante::class);

        $search = $request->get('search', '');

        $solicitantes = Solicitante::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.solicitantes.index',
            compact('solicitantes', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Solicitante::class);

        return view('app.solicitantes.create');
    }

    /**
     * @param \App\Http\Requests\SolicitanteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolicitanteStoreRequest $request)
    {
        $this->authorize('create', Solicitante::class);

        $validated = $request->validated();

        $solicitante = Solicitante::create($validated);

        return redirect()
            ->route('solicitantes.edit', $solicitante)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Solicitante $solicitante
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Solicitante $solicitante)
    {
        $this->authorize('view', $solicitante);

        return view('app.solicitantes.show', compact('solicitante'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Solicitante $solicitante
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Solicitante $solicitante)
    {
        $this->authorize('update', $solicitante);

        return view('app.solicitantes.edit', compact('solicitante'));
    }

    /**
     * @param \App\Http\Requests\SolicitanteUpdateRequest $request
     * @param \App\Models\Solicitante $solicitante
     * @return \Illuminate\Http\Response
     */
    public function update(
        SolicitanteUpdateRequest $request,
        Solicitante $solicitante
    ) {
        $this->authorize('update', $solicitante);

        $validated = $request->validated();

        $solicitante->update($validated);

        return redirect()
            ->route('solicitantes.edit', $solicitante)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Solicitante $solicitante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Solicitante $solicitante)
    {
        $this->authorize('delete', $solicitante);

        $solicitante->delete();

        return redirect()
            ->route('solicitantes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
