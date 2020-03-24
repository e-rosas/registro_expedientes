@extends('layouts.app', ['title' =>'Registar nuevo expediente'])

@section('content')
    @include('components.header', ['title' => 'Nuevo expediente'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">Expediente</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('expedientes.index') }}" class="btn btn-sm btn-primary">Lista de expedientes</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('expedientes.store') }}"  autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Datos del expediente</h6>
                            <div class="pl-lg-4">
                                {{--  Names  --}}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-full_name">Nombre</label>
                                        <input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative{{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last name') }}" value="{{ old('full_name') }}" required autofocus>

                                        @if ($errors->has('full_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('full_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Birth and comments  --}}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('birth_date') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-birth_date">Fecha de nacimiento</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="birth_date" id="input-birth_date" class="form-control form-control-alternative{{ $errors->has('birth_date') ? ' is-invalid' : '' }}"  type="date" required>
                                        </div>
                                        @if ($errors->has('birth_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>
                                {{--  phone_number, email, insured  --}}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }} col-md-6 col-auto">
                                        <label class="form-control-label" for="input-phone_number">Teléfono (opcional)</label>
                                        <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone number') }}" value="{{ old('phone_number') }}">

                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} col-md-6 col-auto">
                                        <label class="form-control-label" for="input-email">Correo (opcional)</label>
                                        <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Optional email') }}" value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('insured') ? ' has-danger' : '' }} col-md-6 col-auto">
                                        <label class="form-control-label" for="input-insured">Asegurado</label>
                                        <input type="checkbox" name="insured" id="input-insured" class="form-control form-control-alternative{{ $errors->has('insured') ? ' is-invalid' : '' }}" value="{{ old('insured') }}">

                                        @if ($errors->has('insured'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insured') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Dates, destroyed --}}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('first_consultation_date') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-first_consultation_date">Fecha de Primera Consulta</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="first_consultation_date" id="input-first_consultation_date" class="form-control form-control-alternative{{ $errors->has('first_consultation_date') ? ' is-invalid' : '' }}"  type="date" required>
                                        </div>
                                        @if ($errors->has('first_consultation_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_consultation_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('last_consultation_date') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-last_consultation_date">Fecha de Última Consulta</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="last_consultation_date" id="input-last_consultation_date" class="form-control form-control-alternative{{ $errors->has('last_consultation_date') ? ' is-invalid' : '' }}"  type="date" required>
                                        </div>
                                        @if ($errors->has('last_consultation_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_consultation_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('destroyed') ? ' has-danger' : '' }} col-md-6 col-auto">
                                        <label class="form-control-label" for="input-destroyed">Destruido</label>
                                        <input type="checkbox" name="destroyed" id="input-destroyed" class="form-control form-control-alternative{{ $errors->has('destroyed') ? ' is-invalid' : '' }}" value="{{ old('destroyed') }}">

                                        @if ($errors->has('destroyed'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('destroyed') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }} col-md-8 col-auto">
                                        <label class="form-control-label" for="input-comments">Observaciones</label>
                                        <input type="text" name="comments" id="input-comments" class="form-control form-control-alternative{{ $errors->has('comments') ? ' is-invalid' : '' }}" placeholder="{{ __('comments') }}" value="{{ old('comments') }}" required>

                                        @if ($errors->has('comments'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comments') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Guardar</button>
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
