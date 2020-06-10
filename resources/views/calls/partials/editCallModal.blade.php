<div class="modal fade" id="modal-update-call" role="dialog" aria-labelledby="modal-call" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Editar llamada') }}</h6>                 
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">                
                        <div class="form-group">
                            {{--  Call --}}
                            <input readonly type="hidden" name="call_id" id="update-call_id" class="form-control"
                                required>
                                <div class="form-row">
                                    {{--  status  --}}
                                    <div class="col-lg-12 form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                            </div>
                                            <select class="form-control" id="update-status">
                                                <option value='0' >{{ __('Paciente vendrá') }}</option>
                                                <option value='1' >{{ __('Paciente no vendrá') }}</option>
                                                <option value='2' >{{ __('Otro') }}</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    {{--  comments  --}}
                                    <div class="col-lg-12 form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                            </div>
                                            <textarea type="text" rows="3" name="comments" id="update-comments" class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}"
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
                                <button onclick="updateCallClick()" id="update_call" class="btn btn-block btn-success">{{ __('Save') }}</button>
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
    function updateCall(id, comments, status){
        $.ajax({
            url: "{{route('calls.update')}}",
            dataType: 'json',
            type:"patch",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
                "comments": comments,
                "status": status
            },
        success: function (response) {
            var calls = response.data;
            displayCalls(calls); //on callsModal
                
            $('#modal-update-call').modal('hide')
            }
        });
            return false;
    }

    function CallData(call_id, comments, status){
            document.getElementById("update-call_id").value = call_id;
            document.getElementById("update-comments").value = comments;
            document.getElementById("update-status").value = status;
    }

    function getCallData(id){
        $.ajax({
            url: "{{route('calls.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "id" : id
            },
        success: function (data) {          
            CallData(data.id, data.comments, data.status_n);                                 
            }
        });
            return false;
    }

    function DeleteCall(id){
        var r = confirm("Confirmar la eliminación de la llamada");
        if(r){
            $.ajax({
                url: "{{route('calls.destroy')}}",
                dataType: 'json',
                type:"delete",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "call_id" : id
                },
            success: function (response) {
                displayCalls(response.data);
                }
            });
            return false;
        }

    }

    function updateCallClick(){
        var call_id = document.getElementById("update-call_id").value;
            var comments = document.getElementById("update-comments").value;
            var status = document.getElementById("update-status").value;

            updateCall(call_id, comments, status);
    }
</script>
    
@endpush