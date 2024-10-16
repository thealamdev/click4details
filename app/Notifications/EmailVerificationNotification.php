<?php

namespace App\Notifications;

use App\Services\Utils\TemporarySignedRoute;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;
    use TemporarySignedRoute;

    /**
     * Create a new notification instance
     * @param  string|null $signedRoute
     * @return void
     */
    public function __construct(public readonly ?string $signedRoute = null)
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
        return (new MailMessage())->subject('Email verification')->markdown('email.registration', [
            'name' => $notifiable->name,
            'link' => self::buildURL($notifiable->getKey(), $notifiable->email, $this->signedRoute)
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
