<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class ApplicantOrdersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Applicant $applicant)
    {
        $this->authorize('view', $applicant);

        $search = $request->get('search', '');

        $orders = $applicant
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Applicant $applicant)
    {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'folio' => ['required', 'unique:orders,folio', 'max:13', 'string'],
            'destino' => [
                'required',
                'in:casa,auto,prestamo,tarjeta de credito',
            ],
            'monto_solicitado' => [
                'bail',
                'required',
                'numeric',
                '    $this->destino =="Casa" || $this->destino=="casa"? "required|between:0,200000":$this->destino == "Auto" || $this->destino=="auto"?"required|between:0,100000":$this->destino == "Prestamo" || $this->destino=="prestamo"?"required|between:0,50000": $this->destino=="tarjeta de credito"?"required|between:0,20000":"required"',
            ],
            'plazo' => ['required', 'max:2', 'between:1,10'],
        ]);

        $order = $applicant->orders()->create($validated);

        return new OrderResource($order);
    }
}
