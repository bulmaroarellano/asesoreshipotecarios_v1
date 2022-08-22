@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Income::class)
                <a href="{{ route('incomes.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.incomes.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.incomes.inputs.empresa')
                            </th>
                            <th class="text-left">
                                @lang('crud.incomes.inputs.comprobante_ingresos')
                            </th>
                            <th class="text-left">
                                @lang('crud.incomes.inputs.salario_bruto')
                            </th>
                            <th class="text-left">
                                @lang('crud.incomes.inputs.salario_neto')
                            </th>
                            <th class="text-left">
                                @lang('crud.incomes.inputs.tipo_empleo')
                            </th>
                            <th class="text-left">
                                @lang('crud.incomes.inputs.fecha_contratacion')
                            </th>
                            <th class="text-left">
                                @lang('crud.incomes.inputs.applicant_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($incomes as $income)
                        <tr>
                            <td>{{ $income->empresa ?? '-' }}</td>
                            <td>{{ $income->comprobante_ingresos ?? '-' }}</td>
                            <td>{{ $income->salario_bruto ?? '-' }}</td>
                            <td>{{ $income->salario_neto ?? '-' }}</td>
                            <td>{{ $income->tipo_empleo ?? '-' }}</td>
                            <td>{{ $income->fecha_contratacion ?? '-' }}</td>
                            <td>
                                {{ optional($income->applicant)->nombre ?? '-'
                                }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $income)
                                    <a
                                        href="{{ route('incomes.edit', $income) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $income)
                                    <a
                                        href="{{ route('incomes.show', $income) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $income)
                                    <form
                                        action="{{ route('incomes.destroy', $income) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">{!! $incomes->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
