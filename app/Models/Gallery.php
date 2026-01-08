<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id', 'name', 'is_main'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
