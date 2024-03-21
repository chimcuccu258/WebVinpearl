<?php

namespace App\Exports;

use App\Models\Tickets;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class TicketExport implements FromQuery, WithHeadings, WithColumnWidths
{
    public function query()
    {
        return Tickets::query()
            ->select(
                'ticketId',
                'serviceId',
                'ticketType',
                'price',
                'created_at',
                'updated_at'
            );
    }

    public function headings(): array
    {
        return [
            'Mã Vé',
            'Mã DV',
            'Loại Vé',
            'Giá Tiền',
            'Ngày Tạo',
            'Ngày Cập Nhật',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 10,
            'C' => 10,
            'D' => 15,
            'E' => 30,
            'F' => 30,
        ];
    }
}