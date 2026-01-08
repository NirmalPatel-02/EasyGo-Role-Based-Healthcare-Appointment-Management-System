<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['doctor_id', 'name'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
