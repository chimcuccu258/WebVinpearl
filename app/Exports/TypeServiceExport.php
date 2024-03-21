<?php

namespace App\Exports;

use App\Models\TypeServices;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class TypeServicesExport implements FromQuery, WithHeadings, WithColumnWidths
{
    public function query()
    {
        return TypeServices::query()
            ->select(
                'typeServiceId',
                'serviceTypeName',
                'created_at',
                'updated_at'
            );
    }

    public function headings(): array
    {
        return [
            'Mã Loại',
            'Tên Loại',
            'Ngày Tạo',
            'Ngày Cập Nhật',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 20,
            'C' => 20,
            'D' => 20,
        ];
    }
}