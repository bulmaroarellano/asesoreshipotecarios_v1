<?php

namespace App\Http\Controllers\Api;

use App\Models\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IncomeResource;
use App\Http\Resources\IncomeCollection;

class ApplicantIncomesController extends Controller
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

        $incomes = $applicant
            ->incomes()
            ->search($search)
            ->latest()
            ->paginate();

        return new IncomeCollection($incomes);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Applicant $applicant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Applicant $applicant)
    {
        $this->authorize('create', Income::class);

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

        $income = $applicant->incomes()->create($validated);

        return new IncomeResource($income);
    }
}
