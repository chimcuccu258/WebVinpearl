<?php

namespace App\Exports;

use App\Models\Customers;

use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class CustomerExport implements FromQuery, WithHeadings, WithColumnWidths
{
    public function query()
    {
        return Customers::query()
            ->select(
                'customers.customerId',
                'customers.fullName',
                'customers.phoneNumber',
                'customers.address',
                'customers.birthday',
                'customers.gender',
                'customers.email',
                'customers.image',
                'customers.created_at',
                'customers.updated_at',
            );
    }
    public function headings(): array
    {
        return [
            'Mã KH',
            'Họ và Tên',
            'Số điện thoại',
            'Địa Chỉ',
            'Ngày Sinh',
            'Giới Tính',
            'Email',
            'Ảnh',
            'Ngày Tạo',
            'Ngày Cập Nhật',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 15,
            'D' => 30,
            'E' => 15,
            'F' => 10,
            'G' => 25,
            'H' => 25,
            'I' => 30,
            'J' => 30,
        ];
    }
}