<!-- Modal -->
<div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="company-label"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyModelLabel">{{ __('content.companies.action.create') }}</h5>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close"> {{ __('content.action.close') }}</button>

            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="companyForm" name="companyForm" class="form-horizontal"
                      method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name"
                               class="col-sm-7 control-label">{{ __('content.companies.table.name') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('content.companies.placeholder.name') }}"
                                   maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name"
                               class="col-sm-7 control-label">{{ __('content.companies.table.email') }}</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('content.companies.placeholder.email') }}"
                                   maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-7 control-label">{{ __('content.companies.table.phone') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="{{ __('content.companies.placeholder.phone') }}"
                                   required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-7 control-label">{{ __('content.companies.table.website') }}</label>
                        <div class="col-sm-12">
                            <input type="url" class="form-control" id="website" name="website" placeholder="{{ __('content.companies.placeholder.website') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-7 control-label">{{ __('content.companies.table.note') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="note" name="note" placeholder="{{ __('content.companies.placeholder.note') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-7 control-label">{{ __('content.companies.table.logo') }} (.jpg, .jpeg,
                            .png)</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="logo" name="logo" accept=".jpg, .jpeg, .png" placeholder="{{ __('content.companies.placeholder.logo') }}">
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
        $('#companyForm').trigger("reset");
        $('#companyModelLabel').html("{{ __('content.companies.action.create') }}");
        $('#id').val('');
        $('#companyModal').modal('show');
        $('#btn-save').html("{{ __('content.action.create') }}");
    }

    $('#companyForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let url = formData.get('id') ? "/admin/companies/" + formData.get('id') : "{{ route('admin.companies.store') }}";
        let type = formData.get('id') ? 'PATCH' : 'POST';
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
                $('#companyForm').trigger("reset");
                $('#companies-table').dataTable().fnDraw(false);
                $('#companyModal').modal('hide');
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
                url: "/admin/companies/" + id,
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    var oTable = $('#companies-table').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }

    function editFunc(id){
        $.ajax({
            type:"GET",
            url: "/admin/companies/" + id + "/edit",
            data: {
                id: id,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json',
            success: function(res){
                $('#companyModelLabel').html("{{ __('content.companies.action.edit') }}");
                $('#btn-save').html("{{ __('content.action.update') }}");
                $('#companyModal').modal('show');
                $('#id').val(res.id);
                $('#name').val(res.name);
                $('#email').val(res.email);
                $('#phone').val(res.phone);
                $('#website').val(res.website);
                $('#note').val(res.note);
            }
        });
    }
</script>
