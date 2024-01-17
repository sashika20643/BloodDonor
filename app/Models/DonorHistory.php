<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blood_camp_id',
        'donation_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bloodCamp()
    {
        return $this->belongsTo(BloodCamp::class, 'blood_camp_id');
    }
}
