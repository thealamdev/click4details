<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance
     * @param  string $urlPath
     * @return void
     */
    public function __construct(public readonly string $urlPath)
    {
        // TODO: Your Code Here...
    }

    /**
     * Get the notification's delivery channels
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification
     * @param  object      $notifiable
     * @return MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())->subject('Reset Password')->markdown('email.password', [
            'name' => $notifiable->name,
            'link' => $this->urlPath
        ]);
    }

    /**
     * Get the array representation of the notification
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
