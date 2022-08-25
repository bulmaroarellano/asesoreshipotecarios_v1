<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ingreso;
use App\Models\Solicitante;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicantIncomesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Solicitante $solicitante;
    public Ingreso $ingreso;
    public $ingresoFechaContratacion;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Ingreso';

    protected $rules = [
        'ingreso.empresa' => ['nullable', 'max:255', 'string'],
        'ingreso.comprobante_ingresos' => [
            'nullable',
            'in:recibos de nómina,recibo de pago por honorarios,recibo de pago por arrendamiento,movimiento de cuenta de ahorro,otro',
        ],
        'ingreso.salario_bruto' => ['nullable', 'max:9'],
        'ingreso.salario_neto' => ['nullable', 'max:9'],
        'ingreso.tipo_empleo' => ['nullable', 'in:formal,informal,otro'],
        'ingresoFechaContratacion' => ['nullable', 'date'],
    ];

    public function mount(Solicitante $solicitante)
    {
        $this->solicitante = $solicitante;
        $this->resetIngresoData();
    }

    public function resetIngresoData()
    {
        $this->ingreso = new Ingreso();

        $this->ingresoFechaContratacion = null;
        $this->ingreso->comprobante_ingresos = 'Recibos de nómina';
        $this->ingreso->tipo_empleo = 'formal';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newIngreso()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.ingresos.new_title');
        $this->resetIngresoData();

        $this->showModal();
    }

    public function editIngreso(Ingreso $ingreso)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.ingresos.edit_title');
        $this->ingreso = $ingreso;

        $this->ingresoFechaContratacion = $this->ingreso->fecha_contratacion->format(
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
        $this->validate();

        if (!$this->ingreso->applicant_id) {
            $this->authorize('create', Ingreso::class);

            $this->ingreso->applicant_id = $this->solicitante->id;
        } else {
            $this->authorize('update', $this->ingreso);
        }

        $this->ingreso->fecha_contratacion = \Carbon\Carbon::parse(
            $this->ingresoFechaContratacion
        );

        $this->ingreso->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Ingreso::class);

        Ingreso::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetIngresoData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->solicitante->ingresos as $ingreso) {
            array_push($this->selected, $ingreso->id);
        }
    }

    public function render()
    {
        return view('livewire.applicant-incomes-detail', [
            'ingresos' => $this->solicitante->ingresos()->paginate(20),
        ]);
    }
}
