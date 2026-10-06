<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderCancelledNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order)
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
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Order Cancelled - TechZone')
            ->greeting('Hello ' . $this->order->first_name . ',')
            ->line('Your order #' . $this->order->order_number . ' has been successfully cancelled.')
            ->line('If you paid online, your refund will be processed back to your original payment method.')
            ->action('View Order Details', url('/orders/' . $this->order->id))
            ->line('Thank you for shopping with TechZone.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'        => 'Order Cancelled',
            'message'      => 'Your order ' . $this->order->order_number . ' has been cancelled.',
            'order_id'     => $this->order->id,
            'order_number' => $this->order->order_number,
        ];
    }
}
