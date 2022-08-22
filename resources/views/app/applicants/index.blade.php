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
                @can('create', App\Models\Applicant::class)
                <a
                    href="{{ route('applicants.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.applicants.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.applicants.inputs.nombre')
                            </th>
                            <th class="text-left">
                                @lang('crud.applicants.inputs.apellidos')
                            </th>
                            <th class="text-left">
                                @lang('crud.applicants.inputs.fecha_de_nacimiento')
                            </th>
                            <th class="text-left">
                                @lang('crud.applicants.inputs.sexo')
                            </th>
                            <th class="text-left">
                                @lang('crud.applicants.inputs.curp')
                            </th>
                            <th class="text-left">
                                @lang('crud.applicants.inputs.correo_electronico')
                            </th>
                            <th class="text-left">
                                @lang('crud.applicants.inputs.direccion')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applicants as $applicant)
                        <tr>
                            <td>{{ $applicant->nombre ?? '-' }}</td>
                            <td>{{ $applicant->apellidos ?? '-' }}</td>
                            <td>
                                {{ $applicant->fecha_de_nacimiento ?? '-' }}
                            </td>
                            <td>{{ $applicant->sexo ?? '-' }}</td>
                            <td>{{ $applicant->curp ?? '-' }}</td>
                            <td>{{ $applicant->correo_electronico ?? '-' }}</td>
                            <td>{{ $applicant->direccion ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $applicant)
                                    <a
                                        href="{{ route('applicants.edit', $applicant) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $applicant)
                                    <a
                                        href="{{ route('applicants.show', $applicant) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $applicant)
                                    <form
                                        action="{{ route('applicants.destroy', $applicant) }}"
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
                            <td colspan="8">{!! $applicants->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
