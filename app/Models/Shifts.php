<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    use HasFactory;
    protected $primaryKey = 'shiftId';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'shiftId',
        'employeeId',
        'shiftNumber',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($shift) {
            // Tạo mã loại nhân viên mới dựa trên mã loại nhân viên cuối cùng
            $lastTypeEmployee = Shifts::query()->orderBy('shiftId', 'desc')->first();
            if ($lastTypeEmployee) {
                $lastCode = $lastTypeEmployee->shiftId;
                $codeNumber = (int)substr($lastCode, 2) + 1;
            } else {
                $codeNumber = 1;
            }
            // Format mã loại nhân viên và gán vào model
            $shift->shiftId = 'shift' . str_pad($codeNumber, 6, '0', STR_PAD_LEFT);
        });
    }

    public function getEmployeeName()
    {
        return $this->belongsTo(Employees::class, 'employeeId', 'employeeId');
    }
}