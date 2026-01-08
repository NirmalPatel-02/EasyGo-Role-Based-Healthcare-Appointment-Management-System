<?php

// app/Models/Wallet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'doctor_id', 'charges', 'debit', 'credit', 'details','payment_id'
    ];
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public static function walletsByDoctor($doctorId)
    {
        return self::where('doctor_id', $doctorId)->get();
    }
}
