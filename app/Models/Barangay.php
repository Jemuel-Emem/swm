<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function complaints(){
        return $this->hasMany(comaplaints::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
