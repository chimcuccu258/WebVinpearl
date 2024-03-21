<?php

namespace App\Exports;

use App\Models\Services;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ServiceExport implements FromQuery, WithHeadings, WithColumnWidths
{
    public function query()
    {
        return Services::query()
            ->select(
                'serviceId',
                'serviceName',
                'description',
                'image',
                'typeServiceId',
                'ranking',
                'phoneService',
                'addressService',
                'created_at',
                'updated_at'
            );
    }

    public function headings(): array
    {
        return [
            'Mã DV',
            'Tên DV',
            'Mô Tả',
            'Ảnh',
            'Mã Loại DV',
            'Xếp Loại',
            'Số Điện Thoại DV',
            'Địa Chỉ DV',
            'Ngày Tạo',
            'Ngày Cập Nhật',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 30,
            'D' => 25,
            'E' => 15,
            'F' => 15,
            'G' => 20,
            'H' => 30,
            'I' => 30,
            'J' => 30,
        ];
    }
}