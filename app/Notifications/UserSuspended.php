<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserSuspended extends Notification implements ShouldQueue
{
    use Queueable;

    public $suspendedUntil;
    public $reason;

    public function __construct($suspendedUntil = null, $reason = null)
    {
        $this->suspendedUntil = $suspendedUntil;
        $this->reason = $reason;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Account Suspended')
            ->line('Hello ' . $notifiable->name . ',')
            ->line('Your account has been suspended by our administrators.');

        if ($this->suspendedUntil) {
            $message->line('Suspension Period: Until ' . $this->suspendedUntil->format('F j, Y'));
        } else {
            $message->line('Status: Indefinite suspension');
        }

        if ($this->reason) {
            $message->line('Reason: ' . $this->reason);
        }

        $message->line('If you believe this is a mistake or have questions, please contact our support team.');

        return $message;
    }
}
