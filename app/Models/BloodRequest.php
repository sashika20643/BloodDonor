<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'status', 'hospital_id', 'blood_bank_id',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function bloodBank()
    {
        return $this->belongsTo(BloodBank::class);
    }
}
