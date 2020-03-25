@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Expediente</h5>
                        <p class="card-text">Registrar un nuevo expediente.</p>
                        <a href="{{ route('expedientes.create') }}" class="btn btn-primary btn-block">Registrar</a>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


@endsection

