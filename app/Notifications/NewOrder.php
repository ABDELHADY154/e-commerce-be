<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Relative\LaravelExpoPushNotifications\Models\PushNotification;

class NewOrder extends Notification
{
    use Queueable;

    public $order;


    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ExpoPushNotifications::class];
    }

    public function toExpoPushNotification($notifiable)
    {
        return (new PushNotification())
            ->title('New order received')
            ->body("Order #{$this->order->id} is ready for processing");
    }
}
