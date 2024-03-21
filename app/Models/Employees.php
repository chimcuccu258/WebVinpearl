<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Employees extends Model
{
    use HasFactory;
    protected $primaryKey = 'employeeId';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'employeeId',
        'fullName',
        'address',
        'birthday',
        'phoneNumber',
        'gender',
        'image',
        'typeEmployeeId',
        'email',
        'password',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($employee) {
            // Tạo mã nhân viên mới dựa trên mã nhân viên cuối cùng
            $lastCustomer = Employees::query()->orderBy('employeeId', 'desc')->first();
            if ($lastCustomer) {
                $lastCode = $lastCustomer->employeeId;
                $codeNumber = (int)substr($lastCode, 2) + 1;
            } else {
                $codeNumber = 1;
            }
            // Format mã nhân viên và gán vào model
            $employee->employeeId = 'employee' . str_pad($codeNumber, 6, '0', STR_PAD_LEFT);

            $employeeID = $employee->employeeId;
            if (request()->hasFile('image')) {
                $image = request()->file('image');
                $image->storeAs("public/images/employee_avt/$employeeID", $employee->image);
            } else {
                $sourcePath = 'public/images/employee_avt/defaultavt.png';
                $destinationDirectory = "public/images/employee_avt/$employeeID";
                $destinationPath = "$destinationDirectory/defaultavt.png";
                Storage::copy($sourcePath, $destinationPath);
            }
        });
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = date('Y-m-d', strtotime(str_replace('/', '-', $value)));
    }

    protected function getBirthday(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attribute) {
                return date('d/m/Y', strtotime($attribute['birthday']));
            }
        );
    }

    public function getEmployeeTypeName()
    {
        return $this->belongsTo(TypeEmployees::class, 'typeEmployeeId', 'typeEmployeeId');
    }
}