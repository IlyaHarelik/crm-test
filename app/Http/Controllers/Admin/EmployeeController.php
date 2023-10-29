<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::all();
            $transformedData = $employees->map(function($employee) {
                return [
                    'id' => $employee->id,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->first_name,
                    'company_name' => $employee->company->name,
                    'email' => $employee->email,
                    'phone' => $employee->phone,
                    'note' => $employee->note,
                ];
            });

            return Datatables::of($transformedData)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">'
                        . __('content.action.edit'). '</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">'
                        . __('content.action.delete'). '</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.employees',);
    }
}
