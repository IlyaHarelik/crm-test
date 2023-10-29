<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 2</title>

    @include('includes.links')
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    @include('includes.navbar')

    @include('includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2  d-flex justify-content-between">
                    <div class="col-sm-6">
                        <h1 class="m-0"> {{ __('content.employees.title') }}</h1>

                    </div><!-- /.col -->
                    <div class="mr-3">
                        <a href="{{ route('admin.employees.export') }}"
                           class="btn btn-success">{{ __('content.action.export') }}</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('includes.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

</body>


<script type="text/javascript">
    $(function () {
        let table = $('#employees-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.employees.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'company_name', name: 'company_name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'note', name: 'note'},
                {data: 'action', name: 'action'},
            ],
            @if(app()->getLocale() === 'ru')
            language: {
                url:  '//cdn.datatables.net/plug-ins/1.13.6/i18n/ru.json',
            },
            columnDefs: [
                {
                    targets: [4],
                    width: '150px',
                },
            ],
            @endif
        });
    });
</script>
</html>

<th>id</th>
<th >{{ __('content.employees.table.first_name') }}</th>
<th>{{ __('content.employees.table.last_name') }}</th>
<th>{{ __('content.employees.table.company') }}</th>
<th width="105px">{{ __('content.employees.table.email') }}</th>
<th>{{ __('content.employees.table.phone') }}</th>
<th width="150px">{{ __('content.employees.table.note') }}</th>
<th width="150px">{{ __('content.employees.table.actions') }}</th>
