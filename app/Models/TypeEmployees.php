<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEmployees extends Model
{
    use HasFactory;
    protected $primaryKey = 'typeEmployeeId';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'typeEmployeeId',
        'employeeTypeName',
        'basicSalary',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($typeEmployee) {
            // Tạo mã loại nhân viên mới dựa trên mã loại nhân viên cuối cùng
            $lastTypeEmployee = TypeEmployees::query()->orderBy('typeEmployeeId', 'desc')->first();
            if ($lastTypeEmployee) {
                $lastCode = $lastTypeEmployee->typeEmployeeId;
                $codeNumber = (int)substr($lastCode, 3) + 1;
            } else {
                $codeNumber = 1;
            }
            // Format mã loại nhân viên và gán vào model
            $typeEmployee->typeEmployeeId = 'typeEmployee' . str_pad($codeNumber, 6, '0', STR_PAD_LEFT);
        });
    }
}