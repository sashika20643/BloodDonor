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
    public function __construct()
    {
        //
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
        return (new MailMessage)
            ->subject('Blood Donation Camp Added')
            ->line('A new blood donation camp has been added:')
            ->line('Organisation Name: ' . $notifiable->organisation_name)
            ->line('Address: ' . $notifiable->address)
            // Add more lines with other details as needed
            ->action('View Blood Donation Camp', url('/blood_donation_camps/' . $notifiable->id))
            ->line('Thank you for using our application!');
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
