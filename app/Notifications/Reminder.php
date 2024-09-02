<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// Collection
use Illuminate\Database\Eloquent\Collection;

class Reminder extends Notification
{
    use Queueable;

    private $message;
    private $images;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $message, Collection $images)
    {
        $this->message = $message;
        $this->images = $images;
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
    public function toMail(object $notifiable): MailMessage
    {
        // TODO: attach all the files dynamically
        return (new MailMessage)
            ->subject('Reminder')
            ->line($this->message['header'])
            ->line($this->message['body'])
            ->line($this->message['info'])
            ->action('Notification Action', url('/tag'))
            ->line('Thank you for using our application!')
            ->attach(public_path('/storage/' . $this->images[0]->storage_filename));
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
