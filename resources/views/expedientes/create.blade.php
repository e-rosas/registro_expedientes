@extends('layouts.app', ['title' =>'Registar nuevo expediente'])

@section('content')
    @include('components.header', ['title' => 'Nuevo expediente'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-md-8 col-auto">
                                <h3 class="mb-0">Expediente</h3>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="{{ route('expedientes.index') }}" class="btn btn-sm btn-primary">Lista de expedientes</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            @if (session('status'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <form method="post" action="{{ route('expedientes.store') }}"  autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Datos del expediente</h6>
                            <div class="pl-lg-4">
                                {{--  Names  --}}
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }} col-md-12">
                                        <label class="form-control-label" for="input-full_name">Nombre</label>
                                        <input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative{{ $errors->has('full_name') ? ' is-invalid' : '' }}"
                                         placeholder="Nombre completo" value="{{ old('full_name') }}" required autofocus>

                                        @if ($errors->has('full_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('full_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Birth  --}}
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('birth_date') ? ' has-danger' : '' }} col-md-4">
                                        <label class="form-control-label" for="input-birth_date">Fecha de nacimiento</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="birth_date" id="input-birth_date" class="form-control form-control-alternative{{ $errors->has('birth_date') ? ' is-invalid' : '' }}"
                                              type="date" required value="{{ old('birth_date') }}">
                                        </div>
                                        @if ($errors->has('birth_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>
                                
                                {{--  phone_number, email --}}
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }} col-md-3">
                                        <label class="form-control-label" for="input-phone_number">Teléfono (opcional)</label>
                                        <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" placeholder="Teléfono (opcional)" value="{{ old('phone_number') }}">

                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} col-md-3">
                                        <label class="form-control-label" for="input-email">Correo (opcional)</label>
                                        <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Correo opcional" value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }} col-md-6">
                                        <label class="form-control-label" for="input-address">Direccion (opcional)</label>
                                        <input type="text" name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Correo opcional" value="{{ old('address') }}">
                                    
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Dates, destroyed --}}
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-year">Año</label>
                                        <input type="numeric" name="year" id="input-year" class="form-control form-control-alternative{{ $errors->has('year') ? ' is-invalid' : '' }}"
                                                    placeholder="Año de caja" value="{{ old('year') }}" required>
                                        @if ($errors->has('year'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('year') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }} col-md-12">
                                        <label class="form-control-label" for="input-comments">Observaciones</label>
                                        <input type="text" name="comments" id="input-comments" class="form-control form-control-alternative{{ $errors->has('comments') ? ' is-invalid' : '' }}" placeholder="Comentarios (opcionales)" value="{{ old('comments') }}">

                                        @if ($errors->has('comments'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comments') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-block">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
