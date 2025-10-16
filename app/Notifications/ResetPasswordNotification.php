<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $logoUrl = url('assets/images/Sad-removebg-preview.png'); // Absolute URL

        return (new MailMessage)
            ->from('info@teamrabbil.com', 'Web.Shadin') // Sender Email
            ->subject('Password Reset Request')
            ->greeting('Hello!')
            ->line('You requested a password reset. Click the button below to reset your password.')
            ->action('Reset Password', url(route('password.reset', $this->token, false)))
            ->line('If you did not request a password reset, no further action is required.')
            ->salutation('Thanks, Your Website Team')
            ->view('emails.reset-password', ['token' => $this->token, 'logoUrl' => $logoUrl]); // Custom Blade Template
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
