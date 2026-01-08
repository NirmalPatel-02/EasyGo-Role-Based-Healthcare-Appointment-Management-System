<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'time_slot'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
