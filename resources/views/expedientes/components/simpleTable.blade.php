<div class="table-responsive" id="expedientes_table">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Enviar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expedientes as $expediente)
            <tr>
                <td>
                    <a href="{{ route('expedientes.show', $expediente->id) }}">
                        {{ $expediente->full_name}}
                    </a>
                </td>
                {{-- <td>{{ $expediente->birth_date->format('Y-M-d') }}</td> --}}
                @if (!$expediente->email || $expediente->email == 'PENDIENTE')
                <td>Correo pendiente</td>
                @else
                <td>
                    <a href="mailto:{{$expediente->email}}">{{ $expediente->email }}</a>
                </td>
                @if ($notSent)
                <td><input type="checkbox" name="expedientes[]" value="{{ $expediente->id }}" checked></td>
                @endif

                @endif

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
