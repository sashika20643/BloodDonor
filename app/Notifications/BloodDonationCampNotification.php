<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BloodDonationCampNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
     protected $bloodDonationCamp;
     public function __construct($bloodDonationCamp)
     {
         $this->bloodDonationCamp = $bloodDonationCamp;
     }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
 public function toMail($notifiable)
    {
        $bloodDonationCamp = $this->bloodDonationCamp;

        return (new MailMessage)
        ->subject('Blood Donation Camp Notification')
        ->line("Dear {$notifiable->name},")
        ->line("A new blood donation camp is scheduled:")
        ->line("Organization Name: {$bloodDonationCamp->organisation_name}")
        ->line("Location: {$bloodDonationCamp->target_location}")
        ->line("Start Date: {$bloodDonationCamp->start_date}")
        ->line("End Date: {$bloodDonationCamp->end_date}")
        ->action('View Blood Donation Camp Details', route('blood_donation_camps.show', $bloodDonationCamp->id))
        ->line('Thank you for your support!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
