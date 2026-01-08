<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'holder_name',
        'bank_name',
        'account_no',
        'ifsc',
        'branch_name',
    ];
}
