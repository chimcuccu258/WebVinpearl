<?php

namespace App\Exports;

use App\Models\Employees;

use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;

class EmployeesExport implements FromQuery, WithHeadings, WithColumnWidths
{

    //Sử dụng FromQuery
    public function query()
    {
        return Employees::query()
            ->select(
                'employees.employeeId',
                'employees.fullName',
                'employees.address',
                'employees.birthday',
                'employees.phoneNumber',
                'employees.gender',
                'employees.image',
                'type_employees.employeeTypeName as typeEmployeeId',
                'employees.email',
                'employees.created_at',
                'employees.updated_at'
            )
            ->leftJoin('type_employees', 'employees.typeEmployeeId', '=', 'type_employees.typeEmployeeId');
    }

    public function headings(): array
    {
        return [
            'Mã NV',
            'Họ và Tên',
            'Địa chỉ',
            'Ngày Sinh',
            'Số Điện Thoại',
            'Giới Tính',
            'Ảnh',
            'Chức vụ',
            'Email',
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
            'D' => 15,
            'E' => 15,
            'F' => 10,
            'G' => 20,
            'H' => 20,
            'I' => 25,
            'J' => 40,
            'K' => 40,
        ];
    }
}