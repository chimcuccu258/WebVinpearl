<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Customers extends Model
{
    use HasFactory;
    protected $primaryKey = 'customerId';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'customerId',
        'fullName',
        'phoneNumber',
        'address',
        'birthday',
        'gender',
        'email',
        'password',
        'image',
    ];
    protected function genderName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attribute) {
                return match ($attribute['gender']) {
                    1 => 'Nam',
                    0 => 'Nữ',
                    2 => 'Không muốn trả lời',
                    default => 'Chưa Cập Nhật',
                };
            }
        );
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($customer) {
            // Tạo mã khách hàng mới dựa trên mã khách hàng cuối cùng
            $lastCustomer = Customers::query()->orderBy('customerId', 'desc')->first();
            if ($lastCustomer) {
                $lastCode = $lastCustomer->customerId;
                $codeNumber = (int)substr($lastCode, 2) + 1;
            } else {
                $codeNumber = 1;
            }
            // Format mã khách hàng và gán vào model
            $customer->customerId = 'customer' . str_pad($codeNumber, 6, '0', STR_PAD_LEFT);
            $userId = $customer->customerId;
            if (request()->hasFile('image')) {
                $image = request()->file('image');
                $image->storeAs("public/images/user_avt/$userId", $customer->image);
            } else {
                $sourcePath = 'public/images/user_avt/defaultavt.png';
                $destinationDirectory = "public/images/user_avt/$userId";
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
}