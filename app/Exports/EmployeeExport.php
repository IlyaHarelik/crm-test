<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public function collection()
    {
        return Employee::select(
            'id',
            'first_name',
            'last_name',
            DB::raw('(SELECT name FROM companies WHERE companies.id = employees.company_id) as company_name'),
            'email',
            'phone',
            'note')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Surname',
            'Company',
            'Email',
            'Phone',
            'Note',
        ];
    }
}
