<?php

namespace App\Models;

use App\Notifications\ThankYouNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodCampDonor extends Model
{
    use HasFactory;

    protected $fillable = [
        'bloodCamp_id', 'user_id', 'request_id','status',
    ];

    public function bloodCamp()
    {
        return $this->belongsTo(BloodCamp::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Listen for the 'saved' event to update last_donation_date
        static::saved(function (BloodCampDonor $bloodCampDonor) {

            if ($bloodCampDonor->status === 'donated' && $bloodCampDonor->user ) {
                $bloodCampDonor->user->load('donor');


                    // Update the last_donation_date in the donors table
                    $bloodCampDonor->user->donor->update(['last_donation_date' => now()]);

                    DonorHistory::create([
                        'user_id' => $bloodCampDonor->user->id,
                        'blood_camp_id' => $bloodCampDonor->bloodCamp_id,
                        'donation_date' => now(),
                    ]);
                    $bloodCampDonor->user->notify(new ThankYouNotification());


            }
        });



    }

}

