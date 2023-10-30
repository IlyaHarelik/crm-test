<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeeExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateEmployeeRequest;
use App\Http\Requests\Admin\DestroyCompanyRequest;
use App\Http\Requests\Admin\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
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
                    return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc(' . $row['id'] . ')" data-original-title="Edit" class="edit btn btn-success btn-sm">'
                        . __('content.action.edit'). '<a href="javascript:void(0);" onClick="deleteFunc(' . $row['id'] . ')" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger btn-sm ml-2">'
                        . __('content.action.delete'). '</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $companies = Company::all();

        return view('pages.employees',compact('companies'));
    }

    public function store(CreateEmployeeRequest $request): JsonResponse
    {
        $employee = Employee::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_id' => $request->company_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'note' => $request->note,
            ]);

        return Response()->json($employee);
    }

    public function update(UpdateEmployeeRequest $request, $id): JsonResponse
    {

        $employee = Employee::find($id);

        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->company_id = $request->input('company_id');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->note = $request->input('note');

        $employee->save();

        return response()->json($employee);
    }

    public function destroy(DestroyCompanyRequest $id)
    {
        /** @var Employee $employee */
        $employee = Employee::find($id)->first();

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $employee->delete();

        return Response()->json($employee);
    }

    public function edit(Request $request): JsonResponse
    {
        /** @var Employee $employee */
        $employee  = Employee::where('id', $request->id)->first();

        return Response()->json($employee);
    }

    public function exportToExcel(): BinaryFileResponse
    {
        return Excel::download(new EmployeeExport, 'companies.xlsx');
    }
}
