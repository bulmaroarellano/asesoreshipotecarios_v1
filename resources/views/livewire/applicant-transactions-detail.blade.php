<div>
    <div class="mb-4">
        @can('create', App\Models\Pedidos::class)
        <button class="btn btn-primary" wire:click="newPedidos">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Pedidos::class)
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

    <x-modal id="-modal" wire:model="showingModal">
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
                            name="pedidos.folio"
                            label="Folio"
                            wire:model="pedidos.folio"
                            maxlength="8"
                            placeholder="Folio"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="pedidos.destino"
                            label="Destino"
                            wire:model="pedidos.destino"
                        >
                            <option value="Casa" {{ $selected == 'Casa' ? 'selected' : '' }} >Casa</option>
                            <option value="Auto" {{ $selected == 'Auto' ? 'selected' : '' }} >Auto</option>
                            <option value="Prestamo" {{ $selected == 'Prestamo' ? 'selected' : '' }} >Prestamo</option>
                            <option value="Tarjeta de credito" {{ $selected == 'Tarjeta de credito' ? 'selected' : '' }} >Tarjeta de credito</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="pedidos.monto_solicitado"
                            label="Monto Solicitado"
                            wire:model="pedidos.monto_solicitado"
                            maxlength="255"
                            placeholder="Monto Solicitado"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="pedidos.plazo"
                            label="Plazo"
                            wire:model="pedidos.plazo"
                            maxlength="2"
                            placeholder="Plazo"
                        ></x-inputs.text>
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
                    <th class="text-left">@lang('crud..inputs.folio')</th>
                    <th class="text-left">@lang('crud..inputs.destino')</th>
                    <th class="text-left">
                        @lang('crud..inputs.monto_solicitado')
                    </th>
                    <th class="text-left">@lang('crud..inputs.plazo')</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($allPedidos as $pedidos)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $pedidos->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $pedidos->folio ?? '-' }}</td>
                    <td class="text-left">{{ $pedidos->destino ?? '-' }}</td>
                    <td class="text-left">
                        {{ $pedidos->monto_solicitado ?? '-' }}
                    </td>
                    <td class="text-left">{{ $pedidos->plazo ?? '-' }}</td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $pedidos)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editPedidos({{ $pedidos->id }})"
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
                    <td colspan="5">{{ $allPedidos->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
