@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('solicitantes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.solicitantes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.solicitantes.inputs.nombre')</h5>
                    <span>{{ $solicitante->nombre ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.solicitantes.inputs.apellidos')</h5>
                    <span>{{ $solicitante->apellidos ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.solicitantes.inputs.fecha_de_nacimiento')
                    </h5>
                    <span>{{ $solicitante->fecha_de_nacimiento ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.solicitantes.inputs.sexo')</h5>
                    <span>{{ $solicitante->sexo ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.solicitantes.inputs.curp')</h5>
                    <span>{{ $solicitante->curp ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.solicitantes.inputs.correo_electronico')
                    </h5>
                    <span>{{ $solicitante->correo_electronico ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.solicitantes.inputs.direccion')</h5>
                    <span>{{ $solicitante->direccion ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('solicitantes.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Solicitante::class)
                <a
                    href="{{ route('solicitantes.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\Pedidos::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Ordenes</h4>

            <livewire:applicant-transactions-detail
                :solicitante="$solicitante"
            />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Ingreso::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Ingresos</h4>

            <livewire:applicant-incomes-detail :solicitante="$solicitante" />
        </div>
    </div>
    @endcan
</div>
@endsection
