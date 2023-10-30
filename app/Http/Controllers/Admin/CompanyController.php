<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CompanyExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCompanyRequest;
use App\Http\Requests\Admin\DestroyCompanyRequest;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                    return '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc(' . $row->id . ')" data-original-title="Edit" class="edit btn btn-success btn-sm">'
                        . __('content.action.edit'). '<a href="javascript:void(0);" onClick="deleteFunc(' . $row->id . ')" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger btn-sm ml-2">'
                        . __('content.action.delete'). '</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.companies',);
    }

    public function store(CreateCompanyRequest $request): JsonResponse
    {
        if ($request->file('logo')) {
            $path = $request->file('logo')->store('public/company_logos');
            $url = substr(Storage::url($path), 1);
        } else {
            $url = null;
        }

        $company = Company::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'website' => $request->website,
                'note' => $request->note,
                'logo_filename' => $url,
            ]);

        return Response()->json($company);
    }

    public function update(UpdateCompanyRequest $request, $id): JsonResponse
    {

        $company = Company::find($id);

        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->phone = $request->input('phone');
        $company->website = $request->input('website');
        $company->note = $request->input('note');

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/company_logos');
            $logoPath = str_replace('public', 'storage', $logoPath);
            $company->logo_filename = $logoPath;
        }

        $company->save();

        return response()->json($company);
    }

    public function destroy(DestroyCompanyRequest $id)
    {
        /** @var Company $company */
        $company = Company::find($id)->first();

        $company->employees()->delete();
        $company->delete();

        return Response()->json($company);
    }

    public function edit(Request $request): JsonResponse
    {
        /** @var Company $company */
        $company  = Company::where('id', $request->id)->first();

        return Response()->json($company);
    }

    public function exportToExcel(): BinaryFileResponse
    {
        return Excel::download(new CompanyExport, 'companies.xlsx');
    }
}
