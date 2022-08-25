<?php

namespace App\Http\Controllers\Api;

use App\Models\Solicitante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SolicitanteResource;
use App\Http\Resources\SolicitanteCollection;
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
            ->paginate();

        return new SolicitanteCollection($solicitantes);
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

        return new SolicitanteResource($solicitante);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Solicitante $solicitante
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Solicitante $solicitante)
    {
        $this->authorize('view', $solicitante);

        return new SolicitanteResource($solicitante);
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

        return new SolicitanteResource($solicitante);
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

        return response()->noContent();
    }
}
