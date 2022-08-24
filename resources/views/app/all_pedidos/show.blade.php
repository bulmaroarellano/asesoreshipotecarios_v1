@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('all-pedidos.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.pedidos.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.pedidos.inputs.folio')</h5>
                    <span>{{ $pedidos->folio ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pedidos.inputs.destino')</h5>
                    <span>{{ $pedidos->destino ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pedidos.inputs.monto_solicitado')</h5>
                    <span>{{ $pedidos->monto_solicitado ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pedidos.inputs.plazo')</h5>
                    <span>{{ $pedidos->plazo ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pedidos.inputs.applicant_id')</h5>
                    <span
                        >{{ optional($pedidos->applicant)->nombre ?? '-'
                        }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('all-pedidos.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Pedidos::class)
                <a
                    href="{{ route('all-pedidos.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
