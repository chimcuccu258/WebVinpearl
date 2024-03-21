<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected $table = 'bills';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'billId';
    protected $fillable = [
        'billId',
        'customerId',
        'employeeId',
        'paymentDate',
        'phoneNumber',
        'email'
    ];

    public static function generateBillId()
    {
        $last = Bills::query()->orderBy('billId', 'desc')->first();
        if ($last) {
            $lastCode = $last->billId;
            $codeNumber = (int)substr($lastCode, 2) + 1;
        } else {
            $codeNumber = 1;
        }
        // Format mã loại nhân viên
        return 'bill' . str_pad($codeNumber, 6, '0', STR_PAD_LEFT);
    }
}