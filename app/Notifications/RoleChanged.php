<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RoleChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public $newRole;

    public function __construct($newRole)
    {
        $this->newRole = $newRole;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Account Role Updated')
            ->line('Hello ' . $notifiable->name . ',')
            ->line('Your account role has been updated.')
            ->line('New Role: ' . ucfirst($this->newRole))
            ->line('This change may affect your access to certain features and administrative functions.')
            ->line('If you have questions about your new role, please contact our support team.');
    }
}
