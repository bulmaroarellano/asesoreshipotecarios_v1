<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pedidos;
use App\Models\Solicitante;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicantTransactionsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Solicitante $solicitante;
    public Pedidos $pedidos;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Pedidos';

    protected $rules = [
        'pedidos.folio' => [
            'required',
            'unique:pedidos,folio',
            'max:8',
            'string',
        ],
        'pedidos.destino' => [
            'required',
            'in:casa,auto,prestamo,tarjeta de credito',
        ],
        'pedidos.monto_solicitado' => ['required', 'max:255', 'string'],
        'pedidos.plazo' => ['required', 'max:2'],
    ];

    public function mount(Solicitante $solicitante)
    {
        $this->solicitante = $solicitante;
        $this->resetPedidosData();
    }

    public function resetPedidosData()
    {
        $this->pedidos = new Pedidos();

        $this->pedidos->destino = 'Casa';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newPedidos()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud..new_title');
        $this->resetPedidosData();

        $this->showModal();
    }

    public function editPedidos(Pedidos $pedidos)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud..edit_title');
        $this->pedidos = $pedidos;

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
        if (!$this->pedidos->applicant_id) {
            $this->validate();
        } else {
            $this->validate([
                'pedidos.folio' => [
                    'required',
                    Rule::unique('pedidos', 'folio')->ignore($this->pedidos),
                    'max:8',
                    'string',
                ],
                'pedidos.destino' => [
                    'required',
                    'in:casa,auto,prestamo,tarjeta de credito',
                ],
                'pedidos.monto_solicitado' => ['required', 'max:255', 'string'],
                'pedidos.plazo' => ['required', 'max:2'],
            ]);
        }

        if (!$this->pedidos->applicant_id) {
            $this->authorize('create', Pedidos::class);

            $this->pedidos->applicant_id = $this->solicitante->id;
        } else {
            $this->authorize('update', $this->pedidos);
        }

        $this->pedidos->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Pedidos::class);

        Pedidos::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetPedidosData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->solicitante->allPedidos as $pedidos) {
            array_push($this->selected, $pedidos->id);
        }
    }

    public function render()
    {
        return view('livewire.applicant-transactions-detail', [
            'allPedidos' => $this->solicitante->allPedidos()->paginate(20),
        ]);
    }
}
