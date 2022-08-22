@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('applicants.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.applicants.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.applicants.inputs.nombre')</h5>
                    <span>{{ $applicant->nombre ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.applicants.inputs.apellidos')</h5>
                    <span>{{ $applicant->apellidos ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.applicants.inputs.fecha_de_nacimiento')</h5>
                    <span>{{ $applicant->fecha_de_nacimiento ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.applicants.inputs.sexo')</h5>
                    <span>{{ $applicant->sexo ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.applicants.inputs.curp')</h5>
                    <span>{{ $applicant->curp ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.applicants.inputs.correo_electronico')</h5>
                    <span>{{ $applicant->correo_electronico ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.applicants.inputs.direccion')</h5>
                    <span>{{ $applicant->direccion ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('applicants.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Applicant::class)
                <a
                    href="{{ route('applicants.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\Order::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Orders</h4>

            <livewire:applicant-orders-detail :applicant="$applicant" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Income::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Incomes</h4>

            <livewire:solicitante-ingresos-detalles :applicant="$applicant" />
        </div>
    </div>
    @endcan
</div>
@endsection
