<div class="modal fade" id="modal-call" role="dialog" aria-labelledby="modal-call" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Agregar llamada') }}</h6>
                        <h4>Teléfono de paciente: {{ $expediente->phone_number }}</h4>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            <div class="form-row">
                                {{--  Date  --}}
                                <div class="col-lg-12 form-group {{ $errors->has('date') ? ' has-danger' : '' }}">
                                    <label for="date">Fecha de llamada</label>
                                    <input type="date" name="date" id="input-call-date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}"
                                        value="{{ $today->format('Y-m-d')}}" required>
                                        @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="form-row">
                                {{--  status  --}}
                                <div class="col-lg-12 form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                        </div>
                                        <select class="form-control" id="input-status">
                                            <option value='0' >{{ __('Paciente vendrá') }}</option>
                                            <option value='1' >{{ __('Paciente no vendrá') }}</option>
                                            <option value='2' >{{ __('Otro') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                
                            <div class="form-row">
                                <div class="col-lg-12 form-group {{ $errors->has('next-date') ? ' has-danger' : '' }}">
                                    <label for="date">Fecha de llamada</label>
                                    <input type="date" name="next-date" id="input-next-date" class="form-control {{ $errors->has('next-date') ? ' is-invalid' : '' }}"
                                        value="{{ $today->addMonth()->format('Y-m-d')}}" required>
                                        @if ($errors->has('next-date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('next-date') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="form-row">
                                {{--  comments  --}}
                                <div class="col-lg-12 form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                        </div>
                                        <textarea type="text" rows="3" name="comments" id="input-call-comments" class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                        value="{{ old('comments') }}" placeholder="{{ __('Comentarios') }}"></textarea>
                                        @if ($errors->has('comments'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comments') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                
                            <div class="text-center">
                                <button id="save_call" class="btn btn-block btn-success">{{ __('Guardar') }}</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    function sendCall(date,
    comments, status, next_date){
        $.ajax({
            url: "{{route('calls.store')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "date": date,
                "comments": comments,
                "status": status,
                "next_date": next_date,
                'expediente_id': {{ $expediente_id }},
            },
        success: function (response) {
            displayCalls(response.data);
            $('#modal-call').modal('hide')

            }
        });
        return false;
    }

    function showEditCallModal(id){

        getCallData(id); //on editCallModal
        $('#modal-update-call').modal('show')

    }

    function displayCalls(data){
        var calls = data;
        var output = "";

        for(var i = 0; i < calls.length; i++){
            output += "<tr value="+calls[i].id+">"
                + "<td>" + (i+1) + "</td>"
                + "<td>" + calls[i].date + "</td>"
                + "<td>" + calls[i].status + "</td>"
                + "<td>" + calls[i].next_date + "</td>"
                + "<td>" + calls[i].comments+ "</td>"
                +'<td class="text-right"><button class="btn btn-icon btn-info btn-sm"  type="button" onClick="showEditCallModal(\'' + calls[i].id + '\')"><span class="btn-inner--icon"><i class="fas fa-pencil-alt fa-2"></i></span></button>'
                +'<button class="btn btn-danger btn-sm btn-icon"  type="button" onClick="DeleteCall(\'' + calls[i].id + '\')"><span class="btn-inner--icon"><i class="fa fa-trash"></i></span></button></td>'
                +"</td></tr>";
        }

        $('#calls_table tbody').html(output);
    }

    $("#save_call").click(function(){
        var date = document.getElementById("input-call-date").value;
        var comments = document.getElementById("input-call-comments").value;
        var status = document.getElementById("input-status").value;
        var next_date = document.getElementById("input-next-date").value;
        sendCall(date, comments, status, next_date);


    });
</script>

@endpush
