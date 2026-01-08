<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id', 
        'amount', 
        'status', 
        'remarks', 
        'bank_name', 
        'account_no', 
        'ifsc', 
        'branch_name', 
        'holder_name',
        'transaction_id',
        'payment_id',
        'file',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
