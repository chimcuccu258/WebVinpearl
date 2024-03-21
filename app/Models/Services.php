<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Services extends Model
{
    use HasFactory;
    protected $primaryKey = 'serviceId';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'serviceId',
        'serviceName',
        'description',
        'image',
        'typeServiceId',
        'ranking',
        'phoneService',
        'addressService',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($service) {
            // Tạo mã dịch vụ mới dựa trên mã dịch vụ cuối cùng

            $lastService = Services::query()->orderBy('serviceId', 'desc')->first();
            if ($lastService) {
                $lastCode = $lastService->serviceId;
                $codeNumber = (int)substr($lastCode, 2) + 1;
            } else {
                $codeNumber = 1;
            }
            // Format mã dịch vụ và gán vào model
            $service->serviceId = 'service' . str_pad($codeNumber, 6, '0', STR_PAD_LEFT);

            $serviceID = $service->serviceId;
            if (request()->hasFile('image')) {
                $image = request()->file('image');
                $image->storeAs("public/images/service_pic/$serviceID", $service->image);
            } else {
                $sourcePath = 'public/images/service_pic/default.png';
                $destinationDirectory = "public/images/service_pic/$serviceID";
                $destinationPath = "$destinationDirectory/default.png";
                Storage::copy($sourcePath, $destinationPath);
            }
        });
        static::updating(function ($service) {
            if (request()->hasFile('image')) {
                $image = request()->file('image');
                $serviceID = $service['serviceId'];
                $imageName = 'picture' . '.' . $image->getClientOriginalExtension();
                $image->storeAs("public/images/service_pic/$serviceID", $imageName);
                $service['image'] = $imageName;
            }
        });
    }
    public function getServiceName()
    {
        return $this->belongsTo(TypeServices::class, 'typeServiceId', 'typeServiceId');
    }
}