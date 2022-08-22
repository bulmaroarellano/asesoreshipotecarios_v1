@php $editing = isset($order) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="destino" label="Destino">
            @php $selected = old('destino', ($editing ? $order->destino : '')) @endphp
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
            value="{{ old('monto_solicitado', ($editing ? $order->monto_solicitado : '')) }}"
            maxlength="255"
            placeholder="Monto Solicitado"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="plazo"
            label="Plazo"
            value="{{ old('plazo', ($editing ? $order->plazo : '')) }}"
            maxlength="2"
            placeholder="Plazo"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
