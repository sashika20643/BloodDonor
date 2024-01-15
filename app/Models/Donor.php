<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Donor extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'user_id', 'blood_group', 'donation_rate', 'medical_report', 'last_donation_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
