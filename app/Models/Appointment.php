<?php

// app/Models/Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'doctor_id', 'time_slot', 'dated', 'status', 'rescheduled','payment_id','first_name','last_name','phone','dob','gender','doctor_price','gst_percent','gst_amount','platform_fee','commission_rate','total_amount','commission_amount','order_id'
    ];

    // Client relationship
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Doctor relationship
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
     // Doctor relationship
     public function review()
     {
         return $this->belongsTo(Review::class, 'appointment_id');
     }
}
