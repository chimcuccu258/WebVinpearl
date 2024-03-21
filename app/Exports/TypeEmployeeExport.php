<?php

namespace App\Exports;

use App\Models\TypeEmployees;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;


class TypeEmployeeExport implements FromQuery, WithHeadings, WithColumnWidths
{
    public function query()
    {
        return TypeEmployees::query()
            ->select(
                'type_employees.typeEmployeeId',
                'type_employees.employeeTypeName',
                'type_employees.basicSalary',
            );
    }

    public function headings(): array
    {
        return [
            'Mã Loại',
            'Tên Loại',
            'Lương Cơ Bản (VND)',

        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 20,
            'C' => 20,
        ];
    }
}