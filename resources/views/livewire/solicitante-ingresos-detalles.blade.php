<div>
    <div class="mb-4">
        @can('create', App\Models\Income::class)
        <button class="btn btn-primary" wire:click="newIncome">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Income::class)
        <button
            class="btn btn-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="icon ion-md-trash"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal id="ingresos-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="income.empresa"
                            label="Empresa"
                            wire:model="income.empresa"
                            maxlength="255"
                            placeholder="Empresa"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="income.comprobante_ingresos"
                            label="Comprobante Ingresos"
                            wire:model="income.comprobante_ingresos"
                        >
                            <option value="Recibos de nómina" {{ $selected == 'Recibos de nómina' ? 'selected' : '' }} >Recibos de n mina</option>
                            <option value="Recibo de pago por honorarios" {{ $selected == 'Recibo de pago por honorarios' ? 'selected' : '' }} >Recibo de pago por honorarios</option>
                            <option value="Recibo de pago por arrendamiento" {{ $selected == 'Recibo de pago por arrendamiento' ? 'selected' : '' }} >Recibo de pago por arrendamiento</option>
                            <option value="Movimiento de cuenta de ahorro" {{ $selected == 'Movimiento de cuenta de ahorro' ? 'selected' : '' }} >Movimiento de cuenta de ahorro</option>
                            <option value="Otro" {{ $selected == 'Otro' ? 'selected' : '' }} >Otro</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="income.salario_bruto"
                            label="Salario Bruto"
                            wire:model="income.salario_bruto"
                            maxlength="9"
                            placeholder="Salario Bruto"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="income.salario_neto"
                            label="Salario Neto"
                            wire:model="income.salario_neto"
                            maxlength="9"
                            placeholder="Salario Neto"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="income.tipo_empleo"
                            label="Tipo Empleo"
                            wire:model="income.tipo_empleo"
                        >
                            <option value="formal" {{ $selected == 'formal' ? 'selected' : '' }} >Formal</option>
                            <option value="informal" {{ $selected == 'informal' ? 'selected' : '' }} >Informal</option>
                            <option value="otro" {{ $selected == 'otro' ? 'selected' : '' }} >Otro</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="incomeFechaContratacion"
                            label="Fecha Contratacion"
                            wire:model="incomeFechaContratacion"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light float-left"
                    wire:click="$toggle('showingModal')"
                >
                    <i class="icon ion-md-close"></i>
                    @lang('crud.common.cancel')
                </button>

                <button type="button" class="btn btn-primary" wire:click="save">
                    <i class="icon ion-md-save"></i>
                    @lang('crud.common.save')
                </button>
            </div>
        </div>
    </x-modal>

    <div class="table-responsive">
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th>
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="text-left">
                        @lang('crud.ingresos.inputs.empresa')
                    </th>
                    <th class="text-left">
                        @lang('crud.ingresos.inputs.comprobante_ingresos')
                    </th>
                    <th class="text-left">
                        @lang('crud.ingresos.inputs.salario_bruto')
                    </th>
                    <th class="text-left">
                        @lang('crud.ingresos.inputs.salario_neto')
                    </th>
                    <th class="text-left">
                        @lang('crud.ingresos.inputs.tipo_empleo')
                    </th>
                    <th class="text-left">
                        @lang('crud.ingresos.inputs.fecha_contratacion')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($incomes as $income)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $income->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $income->empresa ?? '-' }}</td>
                    <td class="text-left">
                        {{ $income->comprobante_ingresos ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $income->salario_bruto ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $income->salario_neto ?? '-' }}
                    </td>
                    <td class="text-left">{{ $income->tipo_empleo ?? '-' }}</td>
                    <td class="text-left">
                        {{ $income->fecha_contratacion ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $income)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editIncome({{ $income->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">{{ $incomes->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
