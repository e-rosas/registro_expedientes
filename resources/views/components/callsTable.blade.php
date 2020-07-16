{{-- Table of calls --}}
<div  class="table-responsive">
    <table id="calls_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Número</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha que vendrá</th>
                <th scope="col">Realizada por</th>
                <th scope="col">Comentarios</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>

            @for ($i = 0; $i < count($calls); $i++)

                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $calls[$i]->date->format('d-M-Y')}}</td>
                    <td>{{ $calls[$i]->status() }}</td>
                    <td>{{ (0 == $calls[$i]->status) ? $calls[$i]->next_date->format('d-M-Y') : '' }}</td>
                    <td>{{ $calls[$i]->user->name }}</td>
                    <td>{{ $calls[$i]->comments }}</td>
                    <td class="text-right">
                        <button class="btn btn-icon btn-info btn-sm"  type="button" onClick="showEditCallModal({{ $calls[$i]->id }})">
                            <span class="btn-inner--icon">
                                <i class="fas fa-pencil-alt fa-2 "></i>
                            </span>
                        </button>
                        <button rel="tooltip" class="btn btn-danger btn-sm btn-icon"  type="button" onClick="DeleteCall({{ $calls[$i]->id }})">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>
<div class="card-footer py-4">
    <nav class="d-flex justify-content-end" aria-label="...">

    </nav>
</div>
