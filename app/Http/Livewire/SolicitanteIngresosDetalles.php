<?php

namespace App\Http\Livewire;

use App\Models\Income;
use Livewire\Component;
use App\Models\Applicant;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SolicitanteIngresosDetalles extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Applicant $applicant;
    public Income $income;
    public $incomeFechaContratacion;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Income';

    protected $rules = [
        'income.empresa' => ['max:255', 'string'],
        'income.comprobante_ingresos' => [
            'in:recibos de nómina,recibo de pago por honorarios,recibo de pago por arrendamiento,movimiento de cuenta de ahorro,otro',
            'required',
        ],
        'income.salario_bruto' => ['max:9', 'numeric', 'gt:$this->sueldo_neto'],
        'income.salario_neto' => [
            '    $this->destino == "Casa" || $this->destino=="casa"? "required|gte:50000":$this->destino === "Auto" || $this->destino=="auto"?"required|gte:30000":$this->destino == "Prestamo" || $this->destino=="prestamo"?"required|gte:20000": $this->destino=="tarjeta de credito"?"required|gte:20000":"required"',
            'numeric',
            'bail',
            'max:9',
            'lt:$this->salario_bruto',
        ],
        'income.tipo_empleo' => ['nullable', 'in:formal,informal,otro'],
        'incomeFechaContratacion' => ['nullable', 'date'],
    ];

    public function mount(Applicant $applicant)
    {
        $this->applicant = $applicant;
        $this->resetIncomeData();
    }

    public function resetIncomeData()
    {
        $this->income = new Income();

        $this->incomeFechaContratacion = null;
        $this->income->comprobante_ingresos = 'Recibos de nómina';
        $this->income->tipo_empleo = 'formal';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newIncome()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.ingresos.new_title');
        $this->resetIncomeData();

        $this->showModal();
    }

    public function editIncome(Income $income)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.ingresos.edit_title');
        $this->income = $income;

        $this->incomeFechaContratacion = $this->income->fecha_contratacion->format(
            'Y-m-d'
        );

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        if (!$this->income->applicant_id) {
            $this->validate();
        } else {
            $this->validate([
                'income.empresa' => ['max:255', 'string'],
                'income.comprobante_ingresos' => [
                    'in:recibos de nómina,recibo de pago por honorarios,recibo de pago por arrendamiento,movimiento de cuenta de ahorro,otro',
                    'required',
                ],
                'income.salario_bruto' => [
                    'max:9',
                    'numeric',
                    'gt:$this->sueldo_neto',
                ],
                'income.salario_neto' => [
                    '    $this->destino == "Casa" || $this->destino=="casa"? "required|gte:50000":$this->destino === "Auto" || $this->destino=="auto"?"required|gte:30000":$this->destino == "Prestamo" || $this->destino=="prestamo"?"required|gte:20000": $this->destino=="tarjeta de credito"?"required|gte:20000":"required"',
                    'numeric',
                    'max:9',
                    'bail',
                    'lt:$this->sueldo_bruto',
                ],
                'income.tipo_empleo' => ['nullable', 'in:formal,informal,otro'],
                'incomeFechaContratacion' => ['nullable', 'date'],
            ]);
        }

        if (!$this->income->applicant_id) {
            $this->authorize('create', Income::class);

            $this->income->applicant_id = $this->applicant->id;
        } else {
            $this->authorize('update', $this->income);
        }

        $this->income->fecha_contratacion = \Carbon\Carbon::parse(
            $this->incomeFechaContratacion
        );

        $this->income->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Income::class);

        Income::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetIncomeData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->applicant->incomes as $income) {
            array_push($this->selected, $income->id);
        }
    }

    public function render()
    {
        return view('livewire.solicitante-ingresos-detalles', [
            'incomes' => $this->applicant->incomes()->paginate(20),
        ]);
    }
}
