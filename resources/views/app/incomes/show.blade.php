@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('incomes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.incomes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.incomes.inputs.empresa')</h5>
                    <span>{{ $income->empresa ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.incomes.inputs.comprobante_ingresos')</h5>
                    <span>{{ $income->comprobante_ingresos ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.incomes.inputs.salario_bruto')</h5>
                    <span>{{ $income->salario_bruto ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.incomes.inputs.salario_neto')</h5>
                    <span>{{ $income->salario_neto ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.incomes.inputs.tipo_empleo')</h5>
                    <span>{{ $income->tipo_empleo ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.incomes.inputs.fecha_contratacion')</h5>
                    <span>{{ $income->fecha_contratacion ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.incomes.inputs.applicant_id')</h5>
                    <span
                        >{{ optional($income->applicant)->nombre ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('incomes.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Income::class)
                <a href="{{ route('incomes.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
