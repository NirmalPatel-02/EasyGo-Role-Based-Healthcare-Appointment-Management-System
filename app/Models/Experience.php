<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id', 'name', 'from', 'to'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
