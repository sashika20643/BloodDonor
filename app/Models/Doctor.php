<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model
{
    use Notifiable;

    protected $fillable = [
    'hospital_id','user_id'
    ];
    use HasFactory;

        // Define the relationship with the User model
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        // Define the relationship with the Hospital model
        public function hospital()
        {
            return $this->belongsTo(Hospital::class);
        }
        public function bloodDonationCamps()
        {
            return $this->hasMany(BloodDonationCamp::class);
        }
}
