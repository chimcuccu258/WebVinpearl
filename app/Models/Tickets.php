<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    protected $primaryKey = 'ticketId';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'ticketId',
        'serviceId',
        'ticketType',
        'price',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($ticket) {
            // Tạo mã vé mới dựa trên mã vé cuối cùng
            $lastTicket = Tickets::query()->orderBy('ticketId', 'desc')->first();
            if ($lastTicket) {
                $lastCode = $lastTicket->ticketId;
                $codeNumber = (int)substr($lastCode, 2) + 1;
            } else {
                $codeNumber = 1;
            }
            // Format mã vé và gán vào model
            $ticket->ticketId = 'ticket' . str_pad($codeNumber, 6, '0', STR_PAD_LEFT);
        });
    }

    public function getServiceName()
    {
        return $this->belongsTo(Services::class, 'serviceId', 'serviceId');
    }
}