<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CompanyExport;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Yajra\DataTables\Facades\Datatables;
use Maatwebsite\Excel\Facades\Excel;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $companies = Company::all();

            return Datatables::of($companies)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">'
                        . __('content.action.edit'). '</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">'
                        . __('content.action.delete'). '</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.companies',);
    }

    public function exportToExcel(): BinaryFileResponse
    {
        return Excel::download(new CompanyExport, 'companies.xlsx');
    }
}
