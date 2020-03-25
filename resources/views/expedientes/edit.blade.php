@extends('layouts.app', ['title' =>'Editar expediente'])

@section('content')
    @include('components.header', ['title' => 'Editar expediente'])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-md-8 col-auto">
                                <h3 class="mb-0">Editar expediente</h3>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="{{ route('expedientes.index') }}" class="btn btn-sm btn-primary">Lista de expedientes</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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
                        <form method="post" action="{{ route('expedientes.update', $expediente) }}"  autocomplete="off">
                            @method('PATCH')
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Datos del expediente registrado</h6>
                            <div class="pl-lg-4">
                                {{--  Names  --}}
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }} col-md-12">
                                        <label class="form-control-label" for="input-full_name">Nombre</label>
                                        <input type="text" name="full_name" id="input-full_name" class="form-control form-control-alternative{{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="Nombre completo" value="{{ $expediente->full_name }}" required autofocus>

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
                                            <input name="birth_date" id="input-birth_date" class="form-control form-control-alternative{{ $errors->has('birth_date') ? ' is-invalid' : '' }}"  type="date" required
                                              value="{{ $expediente->birth_date->format('Y-m-d') }}">
                                        </div>
                                        @if ($errors->has('birth_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4  {{ $errors->has('insured') ? ' has-danger' : '' }}">

                                        <input type="checkbox"  name="insured" id="input-insured" class="custom-control-input {{ $errors->has('insured') ? ' is-invalid' : '' }}" {{ ($expediente->destroyed) ? 'checked' : ''  }}>
                                        <label class="custom-control-label" for="input-insured">Asegurado</label>
                                        @if ($errors->has('insured'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insured') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4  {{ $errors->has('destroyed') ? ' has-danger' : '' }}">

                                        <input type="checkbox" name="destroyed" id="input-destroyed" class="custom-control-input {{ $errors->has('destroyed') ? ' is-invalid' : '' }}" {{ ($expediente->insured) ? 'checked' : ''  }}>
                                        <label class="custom-control-label" for="input-destroyed">Destruido</label>
                                        @if ($errors->has('destroyed'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('destroyed') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  phone_number, email --}}
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }} col-md-6">
                                        <label class="form-control-label" for="input-phone_number">Teléfono (opcional)</label>
                                        <input type="text" name="phone_number" id="input-phone_number" class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                         placeholder="Teléfono opcional" value="{{ $expediente->phone_number }}">

                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} col-md-6">
                                        <label class="form-control-label" for="input-email">Correo (opcional)</label>
                                        <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                         placeholder="Correo opcional" value="{{ $expediente->email }}">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Dates, destroyed --}}
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('first_consultation_date') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-first_consultation_date">Fecha de Primera Consulta</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="first_consultation_date" id="input-first_consultation_date" class="form-control form-control-alternative{{ $errors->has('first_consultation_date') ? ' is-invalid' : '' }}"
                                             value="{{ $expediente->first_consultation_date->format('Y-m-d') }}" type="date" required>
                                        </div>
                                        @if ($errors->has('first_consultation_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_consultation_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('last_consultation_date') ? ' has-danger' : '' }} col-md-4">
                                        <label class="form-control-label" for="input-last_consultation_date">Fecha de Última Consulta</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input name="last_consultation_date" id="input-last_consultation_date" class="form-control form-control-alternative{{ $errors->has('last_consultation_date') ? ' is-invalid' : '' }}"
                                             value="{{ $expediente->last_consultation_date->format('Y-m-d') }}"  type="date" required>
                                        </div>
                                        @if ($errors->has('last_consultation_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_consultation_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }} col-md-12">
                                        <label class="form-control-label" for="input-comments">Observaciones</label>
                                        <input type="text" name="comments" id="input-comments" class="form-control form-control-alternative{{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                         placeholder="Observaciones (opcionales)" value="{{ $expediente->comments }}">

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
