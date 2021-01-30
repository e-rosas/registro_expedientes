@extends('layouts.app', ['title' => 'Correos'])

@section('content')
@include('components.header')

<div class="container-fluid mt--7">

    <div class="form-row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h3 class="mb-0">{{ __('Correos') }}</h3>
                        </div>
                        {{-- <div class="col-md-4">
                                <a href="{{ route('campaigns.list') }}" class="btn btn-sm btn-primary">Lista de
                        campaigns simple</a>
                    </div> --}}
                    {{-- <div class="col-md-4 text-right">
                        <a href="{{ route('campaigns.create') }}" class="btn btn-sm btn-primary">Agregar nueva
                    Correos</a>
                </div> --}}
            </div>
        </div>

        {{--  <form method="get" action="{{ route('campaigns.index') }}">
        <div class="form-row">
            <div class="col-lg-4 col-auto">
                <label for="perPage">{{ __('Cantidad') }}</label>
                <select id="quantity" class="custom-select" name="perPage">
                    <option value='15' {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                    <option value='30' {{ $perPage == 30 ? 'selected' : '' }}>30</option>
                    <option value='50' {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value='100' {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    <option value='150' {{ $perPage == 150 ? 'selected' : '' }}>150</option>
                    <option value='10000' {{ $perPage == 10000 ? 'selected' : '' }}>Todas</option>
                </select>
            </div>
            <div class="col-lg-7">
                <label for="insured">{{ __('Aseguranza') }}</label>
                <select id='insured' class="custom-select" name="insured">
                    <option value='2' {{ $insured == 2 ? 'selected' : '' }}>Ambos</option>
                    <option value='0' {{ $insured == 0 ? 'selected' : '' }}>Sin aseguranza.</option>
                    <option value='1' {{ $insured == 1 ? 'selected' : '' }}>Con aseguranza.</option>
                </select>
            </div>
            <div class="col-lg-1 text-right">
                <br />
                <button name="submit" type="submit" class="btn btn-primary btn-fab btn-icon">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-lg-12 col-auto">
                <label for="example-search-input" class="form-control-label">Buscar</label>
                <input name="search" class="form-control" type="search" placeholder="Buscar campaigns..." id="search">
            </div>

        </div>
        </form> --}}

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
        <div class="table-responsive" id="campaigns_table">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Expediente</th>
                        <th scope="col">Campaña</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Comentarios</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emails as $email)
                    <tr>
                        <td>
                            <a href="{{ route('expedientes.show', $email->expediente) }}">
                                {{ $email->expediente->full_name}}
                            </a>
                        </td>
                        <td><a href="{{ route('campaigns.show', $email->campaign) }}">
                                {{ $email->campaign->name }}
                            </a></td>
                        <td>{{ $email->date->format('Y-M-d') }}</td>
                        <td>{{ $email->comments }}</td>
                        {{-- <td class="text-right">
                            <a class="btn btn-icon btn-info btn-sm" type="button"
                                href="{{route('campaigns.edit', $email)}}">
                        <span class="btn-inner--icon">
                            <i class="fas fa-pencil-alt fa-2"></i>
                        </span>
                        </a>
                        <form method="POST" action="{{ route('campaigns.destroy', $email) }}">
                            @method('DELETE')
                            @csrf
                            <a rel="tooltip" class="btn btn-danger btn-sm btn-icon" type="button"
                                href="{{ route('campaigns.destroy', $email) }}">
                                <span class="btn-inner--icon">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </a>
                        </form>

                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                {{ $emails->links() }}
            </nav>
        </div>
    </div>
</div>
</div>
@include('layouts.footers.auth')
</div>
@endsection
