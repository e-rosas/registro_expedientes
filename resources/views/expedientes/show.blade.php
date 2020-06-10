@extends('layouts.app', ['title' =>'Expediente'])

@section('content')
    @include('components.header', ['title' => 'Expediente'.$expediente->full_name])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-md-8 col-auto">
                                <h3 class="mb-0">Datos del expediente</h3>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="{{ route('expedientes.index') }}" class="btn btn-sm btn-primary">Lista de expedientes</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            {{--  Concept  --}}
                            <div class="col-lg-12 col-auto ">
                                <label class="form-control-label" for="label-patient">Paciente</label>
                                <label id="label-patient">{{ $expediente->full_name }}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            {{--  DOS  --}}
                            <div class="col-md-6 col-auto ">
                                <label class="form-control-label" for="label-birth">Fecha de nacimiento</label>
                                <label id="label-birth">{{ $expediente->birth_date->format('d-m-Y') }}</label>
            
                            </div>
                            <div class="col-md-6 col-auto ">
                                <label class="form-control-label" for="label-phone">Teléfono</label>
                                <label id="label-phone">{{ $expediente->phone_number }}</label>
            
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 col-auto ">
                                <label class="form-control-label" for="label-email">Correo</label>
                                <label id="label-email">{{ $expediente->email }}</label>
                            </div>
                            <div class="col-md-6 col-auto ">
                                <label class="form-control-label" for="label-address">Dirección</label>
                                <label id="label-address">{{ $expediente->address }}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 col-auto ">
                                <label class="form-control-label" for="label-year">Año</label>
                                <label id="label-year">{{ $expediente->year }}</label>
                            </div>
                            <div class="col-md-6 col-auto ">
                                <label class="form-control-label" for="label-diferencia">Diferencia</label>
                                <label id="label-diferencia">{{ $expediente->diferencia() }}</label>
                            </div>
                        </div>
                        {{--  Comments  --}}
                        <div class="col-md-12 col-auto ">
                            <label class="form-control-label" for="label-comments">Observaciones</label>
                            <label id="label-comments">{{ $expediente->comments }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-md-4 col-auto">
                                <h3 class="mb-0">Llamadas al paciente</h3>
                            </div>
                            <div class="col-md-7 text-right">
                                <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modal-call">Registrar nueva llamada</i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('components.callsTable', ['calls'=>$expediente->calls])
                    </div>
                </div>
            </div>
        </div>
        @include('components.callsModal',['expediente_id'=>$expediente->id])
        @include('calls.partials.editCallModal')
        @include('layouts.footers.auth')
    </div>
@endsection
