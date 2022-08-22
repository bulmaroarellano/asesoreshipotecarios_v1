<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\Applicant;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApplicantOrdersDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Applicant $applicant;
    public Order $order;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Order';

    protected $rules = [
        'order.folio' => [
            'required',
            'unique:orders,folio',
            'max:13',
            'string',
        ],
        'order.destino' => [
            'required',
            'in:casa,auto,prestamo,tarjeta de credito',
        ],
        'order.monto_solicitado' => ['required', 'max:255', 'string'],
        'order.plazo' => ['required', 'max:2'],
    ];

    public function mount(Applicant $applicant)
    {
        $this->applicant = $applicant;
        $this->resetOrderData();
    }

    public function resetOrderData()
    {
        $this->order = new Order();

        $this->order->destino = 'Casa';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newOrder()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.applicant_orders.new_title');
        $this->resetOrderData();

        $this->showModal();
    }

    public function editOrder(Order $order)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.applicant_orders.edit_title');
        $this->order = $order;

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
        if (!$this->order->applicant_id) {
            $this->validate();
        } else {
            $this->validate([
                'order.folio' => [
                    'required',
                    Rule::unique('orders', 'folio')->ignore($this->order),
                    'max:13',
                    'string',
                ],
                'order.destino' => [
                    'required',
                    'in:casa,auto,prestamo,tarjeta de credito',
                ],
                'order.monto_solicitado' => ['required', 'max:255', 'string'],
                'order.plazo' => ['required', 'max:2'],
            ]);
        }

        if (!$this->order->applicant_id) {
            $this->authorize('create', Order::class);

            $this->order->applicant_id = $this->applicant->id;
        } else {
            $this->authorize('update', $this->order);
        }

        $this->order->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Order::class);

        Order::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetOrderData();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->applicant->orders as $order) {
            array_push($this->selected, $order->id);
        }
    }

    public function render()
    {
        return view('livewire.applicant-orders-detail', [
            'orders' => $this->applicant->orders()->paginate(20),
        ]);
    }
}
