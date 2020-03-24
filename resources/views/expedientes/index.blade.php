@extends('layouts.app', ['title' => 'Expedientes'])

@section('content')
    @include('components.header', [
        'title' => 'Expedientes',
        'description' => 'Lista de expedientes',
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Expedientes') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('expedientes.create') }}" class="btn btn-sm btn-primary">Agregar nuevo expediente</a>
                            </div>
                        </div>
                    </div>

                    <form  method="post" action="{{ route('expedientes.search') }}" >
                        @csrf
                        <div class="form-group col-md-12 col-auto">
                            <label for="example-search-input" class="form-control-label">Search</label>
                            <input name="search" class="form-control" type="search" required placeholder="Search expedientes..." id="search">
                        </div>
                    </form>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive" id="expedientes_table">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Fecha de nacimiento</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Asegurado</th>
                                    <th scope="col">Primera Consulta</th>
                                    <th scope="col">Última Consulta</th>
                                    <th scope="col">Destruido</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expedientes as $expediente)
                                    <tr>
                                        <td>{{ $expediente->full_name }}</td>
                                        <td>{{ $expediente->birth_date->format('Y-m-d') }}</td>
                                        <td>{{ $expediente->phone_number }}</td>
                                        <td>
                                            <a href="mailto:{{$expediente->email}}">{{ $expediente->email }}</a>
                                        </td>
                                        <td>{{ $expediente->asegurado() }}</td>
                                        <td>{{ $expediente->first_consultation_date->format('l jS \\de F Y') }}</td>
                                        <td>{{ $expediente->last_consultation_date->format('l jS \\de F Y') }}</td>
                                        <td>
                                            <input type="checkbox" {{ ($expediente->destroyed ? 'checked' : '')  }} class="custom-control-input" data-id="{{ $expediente->id }}">
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-icon btn-info btn-sm" type="button" href="{{ route('expedientes.edit', $expediente) }}">
                                                <span class="btn-inner--icon">
                                                    <i class="fas fa-pencil-alt fa-2"></i>
                                                </span>
                                            </button>
                                            <button rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button" href="{{ route('expedientes.destroy', $expediente) }}">
                                                <span class="btn-inner--icon">
                                                    <i class="fa fa-trash"></i>
                                                </span>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $expedientes->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
