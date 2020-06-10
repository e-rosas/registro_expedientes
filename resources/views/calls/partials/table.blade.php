<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Número</th>
                <th scope="col">Expediente</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha que vendrá</th>
                <th scope="col">Comentarios</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calls as $call)
                <tr>
                    <td>{{ $call->number}}</td>
                    <td>
                        <a href="{{ route('expedientes.show', $call->expediente) }}">
                            {{ $call->expediente->full_name}}
                        </a>
                    </td>
                    <td>{{ $call->date->format('d-M-Y')}}</td>
                    <td>{{ $call->status() }}</td>
                    <td>{{ (0 == $call->status) ? $call->next_date->format('d-M-Y') : '' }}</td>
                    <td>{{ $call->comments }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>