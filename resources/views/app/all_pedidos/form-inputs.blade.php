@php $editing = isset($pedidos) @endphp

<div class="row">
    @if($editing)
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="folio"
            label="Folio"
            value="{{ old('folio', ($editing ? $pedidos->folio : '')) }}"
            maxlength="8"
            placeholder="Folio"
            :required="$editing"
        ></x-inputs.text>
    </x-inputs.group>
    @endif

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="destino" label="Destino">
            @php $selected = old('destino', ($editing ? $pedidos->destino : '')) @endphp
            <option value="Casa" {{ $selected == 'Casa' ? 'selected' : '' }} >Casa</option>
            <option value="Auto" {{ $selected == 'Auto' ? 'selected' : '' }} >Auto</option>
            <option value="Prestamo" {{ $selected == 'Prestamo' ? 'selected' : '' }} >Prestamo</option>
            <option value="Tarjeta de credito" {{ $selected == 'Tarjeta de credito' ? 'selected' : '' }} >Tarjeta de credito</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="monto_solicitado"
            label="Monto Solicitado"
            value="{{ old('monto_solicitado', ($editing ? $pedidos->monto_solicitado : '')) }}"
            maxlength="255"
            placeholder="Monto Solicitado"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="plazo"
            label="Plazo"
            value="{{ old('plazo', ($editing ? $pedidos->plazo : '')) }}"
            maxlength="2"
            placeholder="Plazo"
            required
        ></x-inputs.text>
    </x-inputs.group>

    @if($editing) @endif
</div>
