<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id', 'value'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
