<!-- Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="employee-label"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModelLabel">{{ __('content.employees.action.create') }}</h5>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close"> {{ __('content.action.close') }}</button>

            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="employeeForm" name="employeeForm" class="form-horizontal"
                      method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name"
                               class="col-sm-7 control-label">{{ __('content.employees.table.first_name') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="{{ __('content.employees.placeholder.first_name') }}"
                                   maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name"
                               class="col-sm-7 control-label">{{ __('content.employees.table.last_name') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="{{ __('content.employees.placeholder.last_name') }}"
                                   maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_id" class="col-sm-7 control-label">{{ __('content.employees.table.company') }}</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="company_id" name="company_id">
                                <option value=""> {{ __('content.employees.placeholder.company') }} </option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name"
                               class="col-sm-7 control-label">{{ __('content.employees.table.email') }}</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('content.employees.placeholder.email') }}"
                                   maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-7 control-label">{{ __('content.employees.table.phone') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="{{ __('content.employees.placeholder.phone') }}"
                                   required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-7 control-label">{{ __('content.companies.table.note') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="note" name="note" placeholder="{{ __('content.employees.placeholder.note') }}">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10"><br/>
                        <button type="submit" class="btn btn-success"
                                id="btn-save"> {{ __('content.action.create') }}</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function add() {
        $('#employeeForm').trigger("reset");
        $('#employeeModelLabel').html("{{ __('content.employees.action.create') }}");
        $('#id').val('');
        $('#employeeModal').modal('show');
        $('#btn-save').html("{{ __('content.action.create') }}");
    }

    $('#employeeForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let url = formData.get('id') ? "/admin/employees/" + formData.get('id') : "{{ route('admin.employees.store') }}";
        if (formData.get('id')) {
            formData.append("_method", "PATCH");
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#employeeForm').trigger("reset");
                $('#employees-table').dataTable().fnDraw(false);
                $('#employeeModal').modal('hide');
                $('#id').val('');
                {{--alert('{{ __('content.companies.message.add-success') }}');--}}
            },
            error: function (data) {
                const errorString = Object.values(data.responseJSON.errors).join('\n');
                alert(errorString);
            }
        });
    });

    function deleteFunc(id){
        if (confirm("Delete Record?") === true) {
            // ajax
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"DELETE",
                url: "/admin/employees/" + id,
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    var oTable = $('#employees-table').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }

    function editFunc(id){
        $.ajax({
            type:"GET",
            url: "/admin/employees/" + id + "/edit",
            data: {
                id: id,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json',
            success: function(res){
                $('#employeeModelLabel').html("{{ __('content.employees.action.edit') }}");
                $('#btn-save').html("{{ __('content.action.update') }}");
                $('#employeeModal').modal('show');
                $('#id').val(res.id);
                $('#first_name').val(res.first_name);
                $('#last_name').val(res.last_name);
                $('#company_id').val(res.company_id);
                $('#email').val(res.email);
                $('#phone').val(res.phone);
                $('#note').val(res.note);
            }
        });
    }
</script>
