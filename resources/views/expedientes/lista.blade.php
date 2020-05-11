@extends('layouts.app', ['title' => 'Expedientes'])

@section('content')
    @include('components.header')

    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Expedientes') }}</h3>
                            </div>
                        </div>
                        <form method="post" action="{{ route('expedientes.list') }}" >
                            @csrf
                            <div class="row">
                                {{--  start_date  --}}
                                <div class="col-md-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="start_date" id="input-start_date" class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                                        value="{{ $start->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                {{--  end_date  --}}
                                <div class="col-md-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="end_date" id="input-end_date" class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                                        value="{{ $end->format('Y-m-d') }}" required>
                                    </div>
                                </div>
                                {{--  refresh  --}}
                                <div class="col-md-2 text-right">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <span class="btn-inner--icon"><i class="fas fa-sync"></i></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2>Cantidad: {{ count($expedientes) }}</h2>
                        @foreach ($expedientes as $expediente)
                        <p>{{ $expediente->full_name }}</p>

                        @endforeach
                    </div>
                    <div class="card-footer">
                        <form method="POST" action="{{ route('expedientes.destruir') }}">
                            @csrf
                            <input type="hidden" name="end_date" value="{{ $end->format('Y-m-d') }}">
                            <input type="hidden" name="start_date" value="{{ $start->format('Y-m-d') }}">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success btn-block">
                                    Destruir
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
