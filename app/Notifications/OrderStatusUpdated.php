<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    public $order;
    public $oldStatus;
    public $newStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, $oldStatus, $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
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
        $statusMessages = [
            'pending' => 'Your order has been received and is being processed.',
            'processing' => 'Your order is now being prepared for shipping.',
            'shipped' => 'Your order has been shipped and is on its way to you!',
            'delivered' => 'Your order has been delivered successfully!',
            'cancelled' => 'Your order has been cancelled.'
        ];

        $subject = "Order #{$this->order->order_number} Status Updated";
        $message = $statusMessages[$this->newStatus] ?? 'Your order status has been updated.';

        return (new MailMessage)
            ->subject($subject)
            ->greeting("Hello {$notifiable->name}!")
            ->line($message)
            ->line("Order Number: {$this->order->order_number}")
            ->line("Previous Status: " . ucfirst($this->oldStatus))
            ->line("New Status: " . ucfirst($this->newStatus))
            ->line("Total Amount: Rs. " . number_format($this->order->total_amount))
            ->action('View Order Details', url('/orders/' . $this->order->id))
            ->line('Thank you for shopping with us!')
            ->with([
                'order' => $this->order,
                'newStatus' => $this->newStatus
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'message' => "Order status updated from {$this->oldStatus} to {$this->newStatus}"
        ];
    }
}
