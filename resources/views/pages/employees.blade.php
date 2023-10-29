@extends('layouts.employees')

@section('content')
    <table id="employees-table" class="table table-bordered">
        <thead>
        <tr>
            <th>id</th>
            <th >{{ __('content.employees.table.first_name') }}</th>
            <th>{{ __('content.employees.table.last_name') }}</th>
            <th>{{ __('content.employees.table.company') }}</th>
            <th>{{ __('content.employees.table.email') }}</th>
            <th>{{ __('content.employees.table.phone') }}</th>
            <th width="150px">{{ __('content.employees.table.note') }}</th>
            <th width="150px">{{ __('content.employees.table.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

@endsection
