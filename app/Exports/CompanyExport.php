<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    public function collection()
    {
        return Company::select(
            'id',
            'name',
            'email',
            'phone',
            'website',
            'note'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Website',
            'Note',
        ];
    }
}
