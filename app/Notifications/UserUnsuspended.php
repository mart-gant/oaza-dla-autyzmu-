<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUnsuspended extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Account Restored')
            ->line('Hello ' . $notifiable->name . ',')
            ->line('Your account suspension has been lifted. You can now log in and use all features of the platform.')
            ->line('If you have any questions or concerns, please don\'t hesitate to contact our support team.');
    }
}
