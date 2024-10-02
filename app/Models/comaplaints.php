<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comaplaints extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'barangay_id',
        'violation',
        'violation_date',
        'violation_time',
        'proof_image',
    ];
}
