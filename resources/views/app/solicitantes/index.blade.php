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
                @can('create', App\Models\Solicitante::class)
                <a
                    href="{{ route('solicitantes.create') }}"
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
                <h4 class="card-title">
                    @lang('crud.solicitantes.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.solicitantes.inputs.nombre')
                            </th>
                            <th class="text-left">
                                @lang('crud.solicitantes.inputs.apellidos')
                            </th>
                            <th class="text-left">
                                @lang('crud.solicitantes.inputs.fecha_de_nacimiento')
                            </th>
                            <th class="text-left">
                                @lang('crud.solicitantes.inputs.sexo')
                            </th>
                            <th class="text-left">
                                @lang('crud.solicitantes.inputs.curp')
                            </th>
                            <th class="text-left">
                                @lang('crud.solicitantes.inputs.correo_electronico')
                            </th>
                            <th class="text-left">
                                @lang('crud.solicitantes.inputs.direccion')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($solicitantes as $solicitante)
                        <tr>
                            <td>{{ $solicitante->nombre ?? '-' }}</td>
                            <td>{{ $solicitante->apellidos ?? '-' }}</td>
                            <td>
                                {{ $solicitante->fecha_de_nacimiento ?? '-' }}
                            </td>
                            <td>{{ $solicitante->sexo ?? '-' }}</td>
                            <td>{{ $solicitante->curp ?? '-' }}</td>
                            <td>
                                {{ $solicitante->correo_electronico ?? '-' }}
                            </td>
                            <td>{{ $solicitante->direccion ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $solicitante)
                                    <a
                                        href="{{ route('solicitantes.edit', $solicitante) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $solicitante)
                                    <a
                                        href="{{ route('solicitantes.show', $solicitante) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $solicitante)
                                    <form
                                        action="{{ route('solicitantes.destroy', $solicitante) }}"
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
                            <td colspan="8">{!! $solicitantes->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
