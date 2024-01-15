<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodCamp extends Model
{
    use HasFactory;
    protected $fillable = [
        'organisation_name',
        'address',
        'email',
        'name',
        'phone_number',
        'validity',
        'number_of_donors',
        'target_address',
        'target_location',
        'start_date',
        'end_date',
        'image',
        'status',
        'doctor_id',
    ];

    // Define the relationship with the Doctor model
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
