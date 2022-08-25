@php $editing = isset($solicitante) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nombre"
            label="Nombre"
            value="{{ old('nombre', ($editing ? $solicitante->nombre : '')) }}"
            maxlength="255"
            placeholder="Nombre"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="apellidos"
            label="Apellidos"
            value="{{ old('apellidos', ($editing ? $solicitante->apellidos : '')) }}"
            maxlength="255"
            placeholder="Apellidos"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="fecha_de_nacimiento"
            label="Fecha De Nacimiento"
            value="{{ old('fecha_de_nacimiento', ($editing ? optional($solicitante->fecha_de_nacimiento)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="sexo" label="Sexo">
            @php $selected = old('sexo', ($editing ? $solicitante->sexo : '')) @endphp
            <option value="Masculino" {{ $selected == 'Masculino' ? 'selected' : '' }} >Masculino</option>
            <option value="Femenino" {{ $selected == 'Femenino' ? 'selected' : '' }} >Femenino</option>
            <option value="Otro" {{ $selected == 'Otro' ? 'selected' : '' }} >Otro</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="curp"
            label="Curp"
            value="{{ old('curp', ($editing ? $solicitante->curp : '')) }}"
            maxlength="18"
            placeholder="Curp"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="correo_electronico"
            label="Correo Electronico"
            value="{{ old('correo_electronico', ($editing ? $solicitante->correo_electronico : '')) }}"
            maxlength="255"
            placeholder="Correo Electronico"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="direccion"
            label="Direccion"
            maxlength="255"
            required
            >{{ old('direccion', ($editing ? $solicitante->direccion : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
