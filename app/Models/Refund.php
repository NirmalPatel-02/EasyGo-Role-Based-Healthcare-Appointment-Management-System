<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'client_id', 'doctor_id', 'payment_id', 'amount',
        'status', 'reason', 'original_appointment_status', 'refund_id', 'processed_by', 'processed_at', 'failure_reason',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
