@extends('layouts.companies')

@section('content')
    <table id="companies-table" class="table table-bordered">
        <thead>
        <tr>
            <th>id</th>
            <th >{{ __('content.companies.table.name') }}</th>
            <th>{{ __('content.companies.table.email') }}</th>
            <th>{{ __('content.companies.table.phone') }}</th>
            <th width="105px">{{ __('content.companies.table.website') }}</th>
            <th>{{ __('content.companies.table.note') }}</th>
            <th width="150px">{{ __('content.companies.table.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
