<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeServices extends Model
{
    use HasFactory;
    protected $primaryKey = 'typeServiceId';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'typeServiceId',
        'serviceTypeName',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($typeService) {
            // Tạo mã khách hàng mới dựa trên mã khách hàng cuối cùng
            $lastCustomer = TypeServices::query()->orderBy('typeServiceId', 'desc')->first();
            if ($lastCustomer) {
                $lastCode = $lastCustomer->typeServiceId;
                $codeNumber = (int)substr($lastCode, 3) + 1;
            } else {
                $codeNumber = 1;
            }
            // Format mã khách hàng và gán vào model
            $typeService->typeServiceId = 'typeService' . str_pad($codeNumber, 6, '0', STR_PAD_LEFT);
        });
    }
}