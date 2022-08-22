@php $editing = isset($applicant) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nombre"
            label="Nombre"
            value="{{ old('nombre', ($editing ? $applicant->nombre : '')) }}"
            maxlength="255"
            placeholder="Nombre"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="apellidos"
            label="Apellidos"
            value="{{ old('apellidos', ($editing ? $applicant->apellidos : '')) }}"
            maxlength="255"
            placeholder="Apellidos"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="fecha_de_nacimiento"
            label="Fecha De Nacimiento"
            value="{{ old('fecha_de_nacimiento', ($editing ? optional($applicant->fecha_de_nacimiento)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="sexo" label="Sexo">
            @php $selected = old('sexo', ($editing ? $applicant->sexo : '')) @endphp
            <option value="Masculino" {{ $selected == 'Masculino' ? 'selected' : '' }} >Masculino</option>
            <option value="Femenino" {{ $selected == 'Femenino' ? 'selected' : '' }} >Femenino</option>
            <option value="Otro" {{ $selected == 'Otro' ? 'selected' : '' }} >Otro</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="curp"
            label="Curp"
            value="{{ old('curp', ($editing ? $applicant->curp : '')) }}"
            maxlength="18"
            placeholder="Curp"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="correo_electronico"
            label="Correo Electronico"
            value="{{ old('correo_electronico', ($editing ? $applicant->correo_electronico : '')) }}"
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
            >{{ old('direccion', ($editing ? $applicant->direccion : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
