<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood_camp_requests extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blood_camp_id',
        'medical_report_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
    public function bloodCampDonor()
    {
        return $this->hasOne(BloodCampDonor::class);
    }

    public function bloodCamp()
    {
        return $this->belongsTo(BloodCamp::class);
    }
}
