@php $editing = isset($income) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="empresa"
            label="Empresa"
            value="{{ old('empresa', ($editing ? $income->empresa : '')) }}"
            maxlength="255"
            placeholder="Empresa"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="comprobante_ingresos"
            label="Comprobante Ingresos"
        >
            @php $selected = old('comprobante_ingresos', ($editing ? $income->comprobante_ingresos : '')) @endphp
            <option value="Recibos de nómina" {{ $selected == 'Recibos de nómina' ? 'selected' : '' }} >Recibos de n mina</option>
            <option value="Recibo de pago por honorarios" {{ $selected == 'Recibo de pago por honorarios' ? 'selected' : '' }} >Recibo de pago por honorarios</option>
            <option value="Recibo de pago por arrendamiento" {{ $selected == 'Recibo de pago por arrendamiento' ? 'selected' : '' }} >Recibo de pago por arrendamiento</option>
            <option value="Movimiento de cuenta de ahorro" {{ $selected == 'Movimiento de cuenta de ahorro' ? 'selected' : '' }} >Movimiento de cuenta de ahorro</option>
            <option value="Otro" {{ $selected == 'Otro' ? 'selected' : '' }} >Otro</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="salario_bruto"
            label="Salario Bruto"
            value="{{ old('salario_bruto', ($editing ? $income->salario_bruto : '')) }}"
            maxlength="9"
            placeholder="Salario Bruto"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="salario_neto"
            label="Salario Neto"
            value="{{ old('salario_neto', ($editing ? $income->salario_neto : '')) }}"
            maxlength="9"
            placeholder="Salario Neto"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="tipo_empleo" label="Tipo Empleo">
            @php $selected = old('tipo_empleo', ($editing ? $income->tipo_empleo : '')) @endphp
            <option value="formal" {{ $selected == 'formal' ? 'selected' : '' }} >Formal</option>
            <option value="informal" {{ $selected == 'informal' ? 'selected' : '' }} >Informal</option>
            <option value="otro" {{ $selected == 'otro' ? 'selected' : '' }} >Otro</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="fecha_contratacion"
            label="Fecha Contratacion"
            value="{{ old('fecha_contratacion', ($editing ? optional($income->fecha_contratacion)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>
</div>
