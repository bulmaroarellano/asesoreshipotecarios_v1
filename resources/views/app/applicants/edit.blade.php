@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('applicants.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.applicants.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('applicants.update', $applicant) }}"
                class="mt-4"
            >
                @include('app.applicants.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('applicants.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('applicants.create') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
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
